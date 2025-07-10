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
                    <div class="rounded-full justify-center flex bg-gray-300 h-8 w-8 overflow-hidden">

                        @if (Auth::user()->image)
                            <img src="{{ asset('storage/' . Auth::user()->image) }}" alt=""
                                class="aspect-square object-cover">
                        @else
                            <span class="text-xl">{{ Auth::user()->name[0] }}</span>
                        @endif

                    </div>
                    <div class="">{{ Auth::User()->name }}</div>
                </div>
            </div>

            <!-- Form -->
            <div class="mx-6 mb-6">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <form id="createCategoryForm" method="POST"
                        action="/{{ Auth::user()->role }}{{ Request::is('*/mycontent*') ? '/mycontent' : '/content' }}/add/category">
                        @csrf
                        <div class="space-y-6">
                            <!-- Category Name -->
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                                    Category Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="category" name="category" required
                                    placeholder="Enter category name"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('category')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Icon -->
                            <div>
                                <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">
                                    Icon Class <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="icon" name="icon" required placeholder="fas fa-people"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    oninput="updatePreview()">
                                <p class="mt-1 text-sm text-gray-500">
                                    Kunjungi <a href="https://fontawesome.com/search?ic=free" target="_blank"
                                        class="text-blue-600 hover:text-blue-800 underline">FontAwesome</a> untuk
                                    melihat daftar icon yang tersedia
                                </p>
                            </div>

                            <!-- Color -->
                            <div>
                                <label for="color" class="block text-sm font-medium text-gray-700 mb-2">
                                    Color <span class="text-red-500">*</span>
                                </label>
                                <div class="flex items-center space-x-3">
                                    <input type="color" id="color" name="color" value="#3B82F6"
                                        class="h-10 w-16 border border-gray-300 rounded cursor-pointer"
                                        oninput="updatePreview()">
                                    <span id="colorValue" class="text-sm text-gray-600">#3B82F6</span>
                                </div>
                            </div>

                            <!-- Preview -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Preview</label>
                                <div class="p-4 border border-gray-200 rounded-lg bg-gray-50 space-y-4">
                                    <!-- Card Style Preview -->
                                    <div>
                                        <p class="text-xs text-gray-500 mb-2">Card Preview:</p>
                                        <div id="cardPreview"
                                            class="mb-4 flex items-center rounded-lg shadow-md text-sm font-medium max-w-md"
                                            style="background-color: rgba(59, 130, 246, 0.1);">
                                            <div class="px-6 py-3 w-full text-gray-900">
                                                <div class="flex items-center">
                                                    <div id="cardIconPreview"
                                                        class="text-center flex-shrink-0 h-8 w-8 rounded-md flex items-center justify-center text-white"
                                                        style="background-color: #3B82F6;">
                                                        <i
                                                            class="fas fa-question w-5 h-5 justify-center text-center"></i>
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
            // FIXED: Menggunakan ID yang sesuai dengan HTML
            const name = document.getElementById('category').value || 'Category Name';
            const icon = document.getElementById('icon').value || 'fas fa-question';
            const color = document.getElementById('color').value;

            // Update color value display
            document.getElementById('colorValue').textContent = color.toUpperCase();

            // Update card preview
            const cardPreview = document.getElementById('cardPreview');
            cardPreview.style.backgroundColor = hexToRgba(color, 0.1);

            const cardIconPreview = document.getElementById('cardIconPreview');
            cardIconPreview.style.backgroundColor = color;
            cardIconPreview.innerHTML = `<i class="${icon} w-5 h-5"></i>`;

            // Update card title
            document.getElementById('cardTitlePreview').textContent = name || 'How to use Figma Chapter 1';

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

        // Go back function
        function goBack() {
            window.history.back();
        }

        // Initialize preview on page load
        document.addEventListener('DOMContentLoaded', function() {
            updatePreview();

            // Add event listeners for real-time preview updates
            document.getElementById('category').addEventListener('input', updatePreview);
            document.getElementById('color').addEventListener('input', updatePreview);
            document.getElementById('icon').addEventListener('input', updatePreview);
        });
    </script>

</body>

</html>
