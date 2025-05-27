<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <x-headcomponent></x-headcomponent>
</head>

<body>
    <div class="flex flex-1">
        <x-sidebar></x-sidebar>
        <div class=" w-full bg-gray-50">
            <div class=" w-full p-4 text-4xl bg-gray-100 shadow-lg font-semibold"> Management content </div>

            <div class="w-full flex pt-8 px-5 justify-between">
                <div class="flex gap-4">
                    <form class="flex gap-2">
                        <div class=" flex gap-1 items-center rounded-lg border-gray-400 border-2 pl-2">
                            <i class="fas fa-search text-gray-500"></i>
                            <input type="text"
                                class="rounded-lg min-w-56 focus:outline-none px-2 placeholder:font-semibold placeholder:italic"
                                placeholder="Search Content...">
                        </div>

                        <button class="bg-sky-600 px-2 rounded-lg">
                            <p class=" font-medium text-base text-white">search</p>
                        </button>
                    </form>
                    <div class=" flex gap-1 items-center rounded-lg border-gray-400 border-2 px-2">
                        <i class="fas fa-search text-gray-500"></i>
                        <select name="category" id="category" class="min-w-56 focus:outline-none px-2">
                            <option value="writer" class="min-w-56">
                                All Category
                            </option>
                        </select>

                    </div>
                </div>
                <div class="">
                    <a href="" class="px-2 py-1 bg-sky-500 rounded-lg text-white font-semibold"><i class="fas fa-plus text-gray-50"></i> Add Content</a>
                </div>

            </div>
        </div>
    </div>
</body>
<script></script>

</html>
