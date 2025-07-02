<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management - Admin Dashboard</title>
    <x-headcomponent></x-headcomponent>
</head>

<body class="">
    <div class="flex flex-1">
        <x-sidebar></x-sidebar>
        <div class="container mx-auto flex flex-col gap-4">
            <!-- Header -->
            <div class="p-4 shadow-lg font-bold flex bg-gray-100 flex-row justify-between top-0 sticky z-99">
                <div class="text-3xl font-bold pl-4">Management Category</div>
                <div class="profile flex items-center gap-2 pr-4">
                    <i class="fas fa-bell text-xl"></i>
                    <div class="rounded-full justify-center flex bg-gray-300 h-8 w-8">
                        <span class="text-xl">A</span>
                    </div>
                    <div class="">Admin</div>
                </div>
            </div>

            <!-- Search Bar -->
            <div class="m-6 flex justify-between">
                <div class="relative w-2/5">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="searchInput" placeholder="Search categories..."
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        onkeyup="searchCategories()">
                </div>
                <button onclick="createCategory()"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    Create New Category
                </button>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-lg shadow-sm overflow-hidden mx-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-indigo-700 text-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">
                                Name
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">
                                Icon
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">
                                Color
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium  uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody id="categoryTableBody" class="bg-gray-50 divide-y divide-gray-200">
                        <!-- Table rows will be populated by JavaScript -->
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between m-6">
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
                <tr class="hover:bg-gray-100">
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
