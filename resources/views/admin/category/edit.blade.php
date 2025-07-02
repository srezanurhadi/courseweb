<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category - Admin Dashboard</title>
    <x-headcomponent></x-headcomponent>
</head>

<body class="">
    <div class="flex flex-1">
        <x-sidebar></x-sidebar>
        <div class="container mx-auto flex flex-col gap-4">
            <!-- Header -->
            <div class="p-4 shadow-lg font-bold flex bg-gray-100 flex-row justify-between top-0 sticky z-99">
                <div class="text-3xl font-bold pl-4">Edit Category</div>
                <div class="profile flex items-center gap-2 pr-4">
                    <i class="fas fa-bell text-xl"></i>
                    <div class="rounded-full justify-center flex bg-gray-300 h-8 w-8">
                        <span class="text-xl">A</span>
                    </div>
                    <div class="">Admin</div>
                </div>
            </div>

            <!-- Form -->
            <div class="mx-6 mb-6">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <!-- Display validation errors -->
                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-circle text-red-400"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">
                                        There were some errors with your submission
                                    </h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <ul class="list-disc list-inside space-y-1">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form id="editCategoryForm" method="POST" action="{{ route('category.update', $category->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="space-y-6">
                            <!-- Category Name -->
                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                                    Category Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="category" name="category" required
                                    placeholder="Enter category name" value="{{ old('category', $category->category) }}"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('category') border-red-500 @enderror">
                                @error('category')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Icon -->
                            <div>
                                <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">
                                    Icon Class <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="icon" name="icon" required placeholder="fas fa-people"
                                    value="{{ old('icon', $category->icon) }}"
                                    class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('icon') border-red-500 @enderror"
                                    oninput="updatePreview()">
                                @error('icon')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
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
                                    <input type="color" id="color" name="color"
                                        value="{{ old('color', $category->color) }}"
                                        class="h-10 w-16 border border-gray-300 rounded cursor-pointer @error('color') border-red-500 @enderror"
                                        oninput="updatePreview()">
                                    <span id="colorValue"
                                        class="text-sm text-gray-600">{{ strtoupper(old('color', $category->color)) }}</span>
                                </div>
                                @error('color')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
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
                                            style="background-color: {{ $category->color }}20;">
                                            <div class="px-6 py-3 w-full text-gray-900">
                                                <div class="flex items-center">
                                                    <div id="cardIconPreview"
                                                        class="text-center flex-shrink-0 h-8 w-8 rounded-md flex items-center justify-center text-white"
                                                        style="background-color: {{ $category->color }};">
                                                        <i
                                                            class="{{ $category->icon }} w-5 h-5 justify-center text-center"></i>
                                                    </div>
                                                    <div class="ml-4 truncate">
                                                        <span id="cardTitlePreview">{{ $category->category }}</span>
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
                                                style="background-color: {{ $category->color }}33; color: {{ $category->color }};">
                                                {{ $category->category }}
                                            </div>

                                            <!-- Icon Preview -->
                                            <div id="iconPreview"
                                                class="flex items-center justify-center w-10 h-10 rounded-md"
                                                style="background-color: {{ $category->color }}1A;">
                                                <i class="{{ $category->icon }}"
                                                    style="color: {{ $category->color }};"></i>
                                            </div>

                                            <!-- Color Circle Preview -->
                                            <div class="flex items-center">
                                                <div id="colorPreview" class="w-6 h-6 rounded-full mr-3"
                                                    style="background-color: {{ $category->color }};"></div>
                                                <span id="colorTextPreview"
                                                    class="text-sm text-gray-900">{{ strtoupper($category->color) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                            <a href="{{ route('category.index') }}"
                                class="px-6 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Cancel
                            </a>
                            <button type="submit"
                                class="px-6 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 flex items-center gap-2">
                                <i class="fas fa-save"></i>
                                Update Category
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
            const name = document.getElementById('category').value || 'Category Name';
            const icon = document.getElementById('icon').value || 'fas fa-question';
            const color = document.getElementById('color').value;

            // Update color value display
            document.getElementById('colorValue').textContent = color.toUpperCase();

            // Update card preview
            const cardPreview = document.getElementById('cardPreview');
            cardPreview.style.backgroundColor = hexToRgba(color, 0.125);

            const cardIconPreview = document.getElementById('cardIconPreview');
            cardIconPreview.style.backgroundColor = color;
            cardIconPreview.innerHTML = `<i class="${icon} w-5 h-5"></i>`;

            // Update card title
            document.getElementById('cardTitlePreview').textContent = name;

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

        // Initialize preview on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Add event listeners for real-time preview updates
            document.getElementById('category').addEventListener('input', updatePreview);
            document.getElementById('color').addEventListener('input', updatePreview);
            document.getElementById('icon').addEventListener('input', updatePreview);
        });
    </script>

</body>

</html>
