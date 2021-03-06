<header>
    <div class="container max-w-full px-4 md:px-16 pt-4 pb-4">
        <div id="nav">
            <div>
                <nav class="relative flex flex-wrap items-center justify-between md:py-4">
                    <div class="relative z-10 flex-shrink-0 pl-4 py-4 md:p-0">
                        <?php echo ($hasPath == 'home') ? '<a href="#"><img class="h-8 w-8" src="/assets/img/logo_dark.svg" alt="Logo" /></a>' : '<a href="/"><img class="h-8 w-8" src="/assets/img/logo_dark.svg" alt="Logo" /></a>'; ?>
                    </div>
                    <div class="flex-shrink-0 pr-4 md:hidden">
                        <button ref="openButton" @click="open" type="button" class="block text-gray-600 focus:outline-none focus:text-gray-900" aria-label="Menu">
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 6C3 5.44772 3.44772 5 4 5H20C20.5523 5 21 5.44772 21 6C21 6.55228 20.5523 7 20 7H4C3.44772 7 3 6.55228 3 6Z" />
                                <path d="M3 12C3 11.4477 3.44772 11 4 11H20C20.5523 11 21 11.4477 21 12C21 12.5523 20.5523 13 20 13H4C3.44772 13 3 12.5523 3 12Z" />
                                <path d="M4 17C3.44772 17 3 17.4477 3 18C3 18.5523 3.44772 19 4 19H20C20.5523 19 21 18.5523 21 18C21 17.4477 20.5523 17 20 17H4Z" />
                            </svg>
                        </button>
                    </div>
                    <div class="hidden md:block md:ml-10 =md:flex md:items-baseline md:justify-between md:bg-transparent">
                        <div class="lg:absolute inset-0 flex items-center justify-center">
                            <?php echo ($hasPath == 'songs') ? '<a href="#" class="text-sm font-medium text-gray-700">Upload songs</a>' : '<a href="/songs" class="text-sm font-medium text-gray-900 hover:text-gray-700">Upload songs</a>'; ?>
                        </div>
                        <div class="ml-10 relative flex items-baseline">

                            <a href="https://github.com/Dragurimu/risuto" target="_blank" class="inline-flex items-center ml-8 pl-6 pr-2 py-2 font-medium text-sm text-white bg-gray-800 rounded-lg hover:bg-gray-700 focus:outline-none focus:shadow-outline active:bg-gray-900">
                                Github

                                <svg class="ml-2 h-6 w-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill="#FFFFFF" d="M11,10L7.859,6.58c-0.268-0.27-0.268-0.707,0-0.978c0.268-0.27,0.701-0.27,0.969,0l3.83,3.908
                                c0.268,0.271,0.268,0.709,0,0.979l-3.83,3.908c-0.267,0.272-0.701,0.27-0.969,0c-0.268-0.269-0.268-0.707,0-0.978L11,10z" />
                                </svg>
                            </a>

                        </div>
                    </div>
                </nav>
            </div>

            <div class="md:hidden">
                <!-- Off-canvas menu background overlay -->
                <transition enter-class="opacity-0" enter-active-class="ease-out transition-medium" enter-to-class="opacity-100" leave-class="opacity-100" leave-active-class="ease-out transition-medium" leave-to-class="opacity-0" appear>
                    <div v-show="isOpen" class="z-10 fixed inset-0 transition-opacity">
                        <div @click="close" class="absolute inset-0 bg-black opacity-50" tabindex="-1"></div>
                    </div>
                </transition>

                <!-- Off-canvas menu -->
                <transition enter-class="translate-x-full" enter-active-class="ease-out transition-slow" enter-to-class="translate-x-0" leave-class="translate-x-0" leave-active-class="ease-in transition-medium" leave-to-class="translate-x-full" appear>
                    <div v-show="isOpen" class="z-10 fixed inset-y-0 right-0 max-w-xs w-full bg-white transition-transform overflow-y-auto">
                        <div class="relative z-10 bg-white">
                            <div :class="isOpen ? 'block' : 'hidden'" class="absolute top-0 right-0 p-4">
                                <button ref="closeButton" @click="close" type="button" class="text-gray-600 focus:outline-none focus:text-gray-900" aria-label="Close">
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18.2929 19.7071C18.6834 20.0976 19.3166 20.0976 19.7071 19.7071C20.0976 19.3166 20.0976 18.6834 19.7071 18.2929L13.4142 12L19.7071 5.70711C20.0976 5.31658 20.0976 4.68342 19.7071 4.29289C19.3166 3.90237 18.6834 3.90237 18.2929 4.29289L12 10.5858L5.70711 4.29289C5.31658 3.90237 4.68342 3.90237 4.29289 4.29289C3.90237 4.68342 3.90237 5.31658 4.29289 5.70711L10.5858 12L4.29289 18.2929C3.90237 18.6834 3.90237 19.3166 4.29289 19.7071C4.68342 20.0976 5.31658 20.0976 5.70711 19.7071L12 13.4142L18.2929 19.7071Z" />
                                    </svg>
                                </button>
                            </div>
                            <div class="px-4 pt-4 pb-6">
                                <?php echo ($hasPath == 'home') ? '<a href="#"><img class="mt-4 h-8" src="/assets/img/logo_relative.png" alt="Logo" /></a>' : '<a href="/"><img class="mt-4 h-8" src="/assets/img/logo_relative.png" alt="Logo" /></a>'; ?>

                                <a href="#" class="mt-8 block text-xs font-semibold text-gray-600 uppercase tracking-wider">Paginas</a>
                                <?php echo ($hasPath == 'home') ? '<a href="#" class="mt-4 block font-medium text-gray-700">Home</a>' : '<a href="/" class="mt-4 block font-medium text-gray-900 hover:text-gray-700">Home</a>'; ?>
                            </div>
                            <div class="border-t-2 border-gray-200 px-4 pt-6">
                                <?php echo ($hasPath == 'songs') ? '<a href="#" class="block font-medium text-gray-700">Upload songs</a>' : '<a href="/songs" class="block font-medium text-gray-900 hover:text-gray-700">Upload songs</a>'; ?>
                            </div>
                        </div>
                        <div class="relative bg-white px-4 pt-6">
                            <div class="pt-4 pb-6"><a href="https://github.com/Dragurimu/risuto" class="block font-medium text-gray-900 hover:text-gray-700">Github</a></div>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
    </div>
</header>