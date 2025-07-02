<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .modal {
            transition: opacity 0.25s ease;
        }

        .modal-enter {
            opacity: 0;
        }

        .modal-enter-active {
            opacity: 1;
        }

        .modal-exit {
            opacity: 1;
        }

        .modal-exit-active {
            opacity: 0;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-6 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Category Management</h1>
            <button onclick="createCategory()"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                <i class="fas fa-plus"></i>
                Create New Category
            </button>
        </div>

        <!-- Search Bar -->
        <div class="mb-6">
            <div class="relative max-w-md">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" id="searchInput" placeholder="Search categories..."
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    onkeyup="searchCategories()">
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Icon
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Color
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody id="categoryTableBody" class="bg-white divide-y divide-gray-200">
                    <!-- Table rows will be populated by JavaScript -->
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex items-center justify-between mt-6">
            <div class="text-sm text-gray-700">
                Showing <span id="showingStart">1</span> to <span id="showingEnd">10</span> of <span
                    id="totalItems">0</span> results
            </div>
            <div class="flex items-center space-x-2">
                <button id="prevBtn" onclick="changePage(-1)"
                    class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
                    disabled>
                    Previous
                </button>
                <span id="pageInfo" class="px-3 py-2 text-sm font-medium text-gray-700">
                    Page 1 of 1
                </span>
                <button id="nextBtn" onclick="changePage(1)"
                    class="px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed"
                    disabled>
                    Next
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeDeleteModal()"></div>

            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Delete Category</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Are you sure you want to delete this category? This action cannot be undone.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="confirmDelete()"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Delete
                    </button>
                    <button type="button" onclick="closeDeleteModal()"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample data
        const categories = [{
                id: 1,
                name: 'Technology',
                icon: 'fas fa-laptop',
                color: '#3B82F6'
            },
            {
                id: 2,
                name: 'Food & Drink',
                icon: 'fas fa-utensils',
                color: '#EF4444'
            },
            {
                id: 3,
                name: 'Travel',
                icon: 'fas fa-plane',
                color: '#10B981'
            },
            {
                id: 4,
                name: 'Sports',
                icon: 'fas fa-football',
                color: '#F59E0B'
            },
            {
                id: 5,
                name: 'Music',
                icon: 'fas fa-music',
                color: '#8B5CF6'
            },
            {
                id: 6,
                name: 'Education',
                icon: 'fas fa-graduation-cap',
                color: '#06B6D4'
            },
            {
                id: 7,
                name: 'Health',
                icon: 'fas fa-heart',
                color: '#EC4899'
            },
            {
                id: 8,
                name: 'Business',
                icon: 'fas fa-briefcase',
                color: '#6B7280'
            },
            {
                id: 9,
                name: 'Art & Design',
                icon: 'fas fa-palette',
                color: '#F97316'
            },
            {
                id: 10,
                name: 'Gaming',
                icon: 'fas fa-gamepad',
                color: '#7C3AED'
            },
            {
                id: 11,
                name: 'Photography',
                icon: 'fas fa-camera',
                color: '#059669'
            },
            {
                id: 12,
                name: 'Fashion',
                icon: 'fas fa-tshirt',
                color: '#DC2626'
            },
            {
                id: 13,
                name: 'Books',
                icon: 'fas fa-book',
                color: '#92400E'
            },
            {
                id: 14,
                name: 'Movies',
                icon: 'fas fa-film',
                color: '#1F2937'
            },
            {
                id: 15,
                name: 'Nature',
                icon: 'fas fa-leaf',
                color: '#16A34A'
            }
        ];

        let filteredCategories = [...categories];
        let currentPage = 1;
        const itemsPerPage = 10;
        let categoryToDelete = null;

        // Helper function to convert hex to rgba
        function hexToRgba(hex, alpha) {
            const r = parseInt(hex.slice(1, 3), 16);
            const g = parseInt(hex.slice(3, 5), 16);
            const b = parseInt(hex.slice(5, 7), 16);
            return `rgba(${r}, ${g}, ${b}, ${alpha})`;
        }

        function renderTable() {
            const tableBody = document.getElementById('categoryTableBody');
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const currentItems = filteredCategories.slice(startIndex, endIndex);

            tableBody.innerHTML = currentItems.map(category => `
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium" style="background-color: ${hexToRgba(category.color, 0.2)}; color: ${category.color};">
                            ${category.name}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center justify-center w-10 h-10 rounded-md" style="background-color: ${hexToRgba(category.color, 0.1)};">
                            <i class="${category.icon}" style="color: ${category.color};"></i>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-6 h-6 rounded-full mr-3" style="background-color: ${category.color};"></div>
                            <span class="text-sm text-gray-900">${category.color.toUpperCase()}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button 
                            onclick="editCategory(${category.id})"
                            class="text-indigo-600 hover:text-indigo-900 mr-4 inline-flex items-center"
                        >
                            <i class="fas fa-edit mr-1"></i>
                            Edit
                        </button>
                        <button 
                            onclick="deleteCategory(${category.id})"
                            class="text-red-600 hover:text-red-900 inline-flex items-center"
                        >
                            <i class="fas fa-trash mr-1"></i>
                            Delete
                        </button>
                    </td>
                </tr>
            `).join('');

            updatePagination();
        }

        function updatePagination() {
            const totalItems = filteredCategories.length;
            const totalPages = Math.ceil(totalItems / itemsPerPage);
            const startIndex = (currentPage - 1) * itemsPerPage + 1;
            const endIndex = Math.min(currentPage * itemsPerPage, totalItems);

            document.getElementById('showingStart').textContent = totalItems > 0 ? startIndex : 0;
            document.getElementById('showingEnd').textContent = endIndex;
            document.getElementById('totalItems').textContent = totalItems;
            document.getElementById('pageInfo').textContent = `Page ${currentPage} of ${totalPages}`;

            document.getElementById('prevBtn').disabled = currentPage === 1;
            document.getElementById('nextBtn').disabled = currentPage === totalPages || totalPages === 0;
        }

        function changePage(direction) {
            const totalPages = Math.ceil(filteredCategories.length / itemsPerPage);
            const newPage = currentPage + direction;

            if (newPage >= 1 && newPage <= totalPages) {
                currentPage = newPage;
                renderTable();
            }
        }

        function searchCategories() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            filteredCategories = categories.filter(category =>
                category.name.toLowerCase().includes(searchTerm)
            );
            currentPage = 1;
            renderTable();
        }

        function createCategory() {
            alert('Create new category functionality would be implemented here');
        }

        function editCategory(id) {
            const category = categories.find(c => c.id === id);
            alert(`Edit category functionality would be implemented here for: ${category.name}`);
        }

        function deleteCategory(id) {
            categoryToDelete = id;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            categoryToDelete = null;
        }

        function confirmDelete() {
            if (categoryToDelete) {
                const index = categories.findIndex(c => c.id === categoryToDelete);
                if (index > -1) {
                    categories.splice(index, 1);
                    searchCategories(); // Refresh the filtered list and table
                }
                closeDeleteModal();
            }
        }

        // Initialize the table
        renderTable();
    </script>
</body>

</html>
