{{-- resources/views/components/home/footer.blade.php --}}

<footer class="bg-unida-blue text-gray-300">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

        {{-- Grid container for the three columns --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- Column 1: About Section --}}
            <div class="space-y-4">
                {{-- Make sure the image path is correct --}}
                <img class="h-10" src="{{ asset('asset/homepage/unida-colab.png') }}"
                    alt="UNIDA Gontor Collaboration Logo">
                <p class="text-sm text-gray-400 leading-relaxed">
                    Universitas Darussalam Gontor is a quality and meaningful pesantren-based university, a centre for
                    science development oriented to the Islamisation of contemporary knowledge, and a centre for the
                    study of the language of the Qur'an for the welfare of mankind.
                </p>
                <p class="text-sm text-gray-500 pt-4">
                    © {{ date('Y') }} Universitas Darussalam Gontor
                </p>
            </div>

            {{-- Column 2: Quick Links --}}
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white hover:underline transition-colors">About
                            Us</a>
                    </li>
                    <li>
                        <a href="#"
                            class="text-gray-400 hover:text-white hover:underline transition-colors">Services</a>
                    </li>
                    <li>
                        <a href="#" class="text-gray-400 hover:text-white hover:underline transition-colors">Case
                            Study</a>
                    </li>
                </ul>
            </div>

            {{-- Column 3: Contact Us --}}
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Contact Us</h3>
                <ul class="space-y-3 text-gray-400">
                    {{-- Phone --}}
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-500 mt-1 flex-shrink-0" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5h-1.5A11.5 11.5 0 013.5 6H5a1.5 1.5 0 011.5-1.5H2z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>(+62) 81-3337-31713</span>
                    </li>
                    {{-- Email --}}
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-500 mt-1 flex-shrink-0" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z" />
                            <path
                                d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z" />
                        </svg>
                        <span>rektorat@unida.gontor.ac.id</span>
                    </li>
                    {{-- Address --}}
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-500 mt-1 flex-shrink-0" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9.69 18.933l.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 00.281-.14c.186-.1.4-.22.653-.364.253-.144.55-.326.89-.552.34-.227.73-.508 1.13-.832a10.19 10.19 0 002.34-2.521c.24-.31.45-.634.63-.976.18-.34.32-.703.43-1.093.11-.39.19-.807.24-1.248.05-.44.06-.91.06-1.405 0-.85-.1-1.67-.29-2.44-.19-.77-.47-1.51-.82-2.2-.34-.68-.78-1.32-1.28-1.89-1.08-1.24-2.5-2.11-4.14-2.41a.75.75 0 00-.67.04c-1.64.3-3.06 1.17-4.14 2.41-.5.57-.94 1.21-1.28 1.89-.35.69-.63 1.43-.82 2.2-.19.77-.29 1.59-.29 2.44 0 .495.01.968.06 1.405.05.44.13.852.24 1.248.11.39.25.753.43 1.093.18.342.39.666.63.976a10.19 10.19 0 002.34 2.521 21.36 21.36 0 001.13.832c.34.226.637.408.89.552.253.144.467.264.653.364a5.745 5.745 0 00.28.14l.025.011.006.003zM10 2.25a.75.75 0 01.75.75v2.5a.75.75 0 01-1.5 0v-2.5A.75.75 0 0110 2.25z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Jl. Raya Siman, Demangan, Siman, Ponorogo, East Java, Indonesia, 63471</span>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</footer>
