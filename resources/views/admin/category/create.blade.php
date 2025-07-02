<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category - Admin Dashboard</title>
    <x-headcomponent></x-headcomponent>
</head>

<body class="">
    <div class="flex flex-1">
        <x-sidebar></x-sidebar>
        <div class="container mx-auto flex flex-col gap-4">
            <!-- Header -->
            <div class="p-4 shadow-lg font-bold flex bg-gray-100 flex-row justify-between top-0 sticky z-99">
                <div class="text-3xl font-bold pl-4">Create New Category</div>
                <div class="profile flex items-center gap-2 pr-4">
                    <i class="fas fa-bell text-xl"></i>
                    <div class="rounded-full justify-center flex bg-gray-300 h-8 w-8">
                        <span class="text-xl">A</span>
                    </div>
                    <div class="">Admin</div>
                </div>
            </div>

            <!-- Breadcrumb -->
            <div class="mx-6 mt-4">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="#" onclick="goBack()"
                                class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                                <i class="fas fa-home mr-2"></i>
                                Management Category
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Create New Category</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Form -->
            <div class="mx-6 mb-6">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <form id="createCategoryForm" onsubmit="handleSubmit(event)">
                        <div class="space-y-6">
                            <!-- Category Name -->
                            <div>
                                <label for="categoryName" class="block text-sm font-medium text-gray-700 mb-2">
                                    Category Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="categoryName" name="categoryName" required
                                    placeholder="Enter category name"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Icon -->
                            <div>
                                <label for="categoryIcon" class="block text-sm font-medium text-gray-700 mb-2">
                                    Icon Class <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="categoryIcon" name="categoryIcon" required
                                    placeholder="fas fa-person"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    oninput="updatePreview()">
                                <p class="mt-1 text-sm text-gray-500">
                                    Kunjungi <a href="https://fontawesome.com/icons" target="_blank"
                                        class="text-blue-600 hover:text-blue-800 underline">FontAwesome</a> untuk
                                    melihat daftar icon yang tersedia
                                </p>
                            </div>

                            <!-- Color -->
                            <div>
                                <label for="categoryColor" class="block text-sm font-medium text-gray-700 mb-2">
                                    Color <span class="text-red-500">*</span>
                                </label>
                                <div class="flex items-center space-x-3">
                                    <input type="color" id="categoryColor" name="categoryColor" value="#3B82F6"
                                        class="h-10 w-16 border border-gray-300 rounded cursor-pointer"
                                        oninput="updatePreview()">
                                    <span id="colorValue" class="text-sm text-gray-600">#3B82F6</span>
                                </div>
                            </div>

                            <!-- Preview -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Preview</label>
                                <div class="p-4 border border-gray-200 rounded-lg bg-gray-50 spcae-y-4">

                                    <!-- Card Style Preview -->
                                    <div>
                                        <p class="text-xs text-gray-500 mb-2">Card Preview:</p>
                                        <div id="cardPreview"
                                            class="flex items-center rounded-lg shadow-md text-sm font-medium max-w-md"
                                            style="background-color: rgba(59, 130, 246, 0.1);">
                                            <div class="px-6 py-3 w-full text-gray-900">
                                                <div class="flex items-center border-2">
                                                    <div id="cardIconPreview"
                                                        class="border-2 border-black flex-shrink-0 h-8 w-8 rounded-md flex items-center justify-center text-white"
                                                        style="background-color: #3B82F6;">
                                                        <i class="fas fa-question w-5 h-5 border-2 border-black"></i>
                                                    </div>
                                                    <div class="ml-4 truncate">
                                                        <span id="cardTitlePreview">How to use Figma Chapter 1</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <p class="text-xs text-gray-500 mb-2">Components Preview:</p>
                                        <div class="flex items-center space-x-4">
                                            <!-- Category Badge Preview -->
                                            <div id="categoryPreview"
                                                class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium"
                                                style="background-color: rgba(59, 130, 246, 0.2); color: #3B82F6;">
                                                Category Name
                                            </div>

                                            <!-- Icon Preview -->
                                            <div id="iconPreview"
                                                class="flex items-center justify-center w-10 h-10 rounded-md"
                                                style="background-color: rgba(59, 130, 246, 0.1);">
                                                <i class="fas fa-question" style="color: #3B82F6;"></i>
                                            </div>

                                            <!-- Color Circle Preview -->
                                            <div class="flex items-center">
                                                <div id="colorPreview" class="w-6 h-6 rounded-full mr-3"
                                                    style="background-color: #3B82F6;"></div>
                                                <span id="colorTextPreview" class="text-sm text-gray-900">#3B82F6</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                            <button type="button" onclick="goBack()"
                                class="px-6 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-6 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 flex items-center gap-2">
                                <i class="fas fa-save"></i>
                                Create Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                    <i class="fas fa-check text-green-600 text-xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mt-4">Success!</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">Category has been created successfully.</p>
                </div>
                <div class="items-center px-4 py-3">
                    <button onclick="redirectToManagement()"
                        class="px-4 py-2 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Helper function to convert hex to rgba
        function hexToRgba(hex, alpha) {
            const r = parseInt(hex.slice(1, 3), 16);
            const g = parseInt(hex.slice(3, 5), 16);
            const b = parseInt(hex.slice(5, 7), 16);
            return `rgba(${r}, ${g}, ${b}, ${alpha})`;
        }

        // Update preview when inputs change
        function updatePreview() {
            const name = document.getElementById('categoryName').value || 'Category Name';
            const icon = document.getElementById('categoryIcon').value || 'fas fa-question';
            const color = document.getElementById('categoryColor').value;

            // Update color value display
            document.getElementById('colorValue').textContent = color.toUpperCase();

            // Update card preview
            const cardPreview = document.getElementById('cardPreview');
            cardPreview.style.backgroundColor = hexToRgba(color, 0.1);

            const cardIconPreview = document.getElementById('cardIconPreview');
            cardIconPreview.style.backgroundColor = color;
            cardIconPreview.innerHTML = `<i class="${icon} w-5 h-5"></i>`;

            // Update category preview
            const categoryPreview = document.getElementById('categoryPreview');
            categoryPreview.textContent = name;
            categoryPreview.style.backgroundColor = hexToRgba(color, 0.2);
            categoryPreview.style.color = color;

            // Update icon preview
            const iconPreview = document.getElementById('iconPreview');
            iconPreview.style.backgroundColor = hexToRgba(color, 0.1);
            iconPreview.innerHTML = `<i class="${icon}" style="color: ${color};"></i>`;

            // Update color circle preview
            document.getElementById('colorPreview').style.backgroundColor = color;
            document.getElementById('colorTextPreview').textContent = color.toUpperCase();
        }

        // Handle form submission
        function handleSubmit(event) {
            event.preventDefault();

            const formData = new FormData(event.target);
            const categoryData = {
                name: formData.get('categoryName'),
                icon: formData.get('categoryIcon'),
                color: formData.get('categoryColor')
            };

            // Here you would typically send the data to your backend
            console.log('Creating category:', categoryData);

            // Show success modal
            document.getElementById('successModal').classList.remove('hidden');
        }

        // Go back to management page
        function goBack() {
            // In a real application, this would navigate to the management page
            // For now, we'll just show an alert
            if (confirm('Are you sure you want to go back? Any unsaved changes will be lost.')) {
                window.history.back();
                // Or redirect to management page: window.location.href = 'management-category.html';
            }
        }

        // Redirect to management page after successful creation
        function redirectToManagement() {
            // In a real application, this would redirect to the management page
            // window.location.href = 'management-category.html';
            alert('Redirecting to Management Category page...');
            window.history.back();
        }

        // Initialize preview on page load
        document.addEventListener('DOMContentLoaded', function() {
            updatePreview();

            // Add event listeners for real-time preview updates
            document.getElementById('categoryName').addEventListener('input', updatePreview);
            document.getElementById('categoryColor').addEventListener('input', updatePreview);
        })
    </script>

</body>

</html>
