<x-home.app>
    <section class="relative py-24 bg-unida-blue" data-aos="fade-in">
        <div class="relative container mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold text-white mb-2" data-aos="fade-up" data-aos-delay="100">
                {{ $service['title'] }}
            </h1>
            <p class="text-gray-300" data-aos="fade-up" data-aos-delay="200">
                <a href="{{ route('home') }}" class="hover:underline">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('services') }}" class="hover:underline">Services</a>
                <span class="mx-2">/</span>
                <span class="text-white">{{ $service['title'] }}</span>
            </p>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-12">

                <aside class="w-full lg:w-1/4" data-aos="fade-right">
                    <div class="bg-unida-blue p-6 rounded-lg">
                        <h3 class="text-xl font-semibold mb-4 pb-4 border-b">Services Category</h3>
                        <ul class="space-y-2">
                            @foreach ($allServices as $sidebarService)
                                <li>
                                    <a href="{{ route('services.show', $sidebarService['slug']) }}"
                                        class="flex justify-between items-center p-3 rounded-md font-medium transition-colors {{ $sidebarService['slug'] == $service['slug'] ? 'bg-slate-100 text-unida-blue' : 'hover:bg-gray-300 hover:text-unida-blue' }}">
                                        <span>{{ $sidebarService['title'] }}</span>
                                        <span>&rarr;</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </aside>

                <main class="w-full lg:w-3/4" data-aos="fade-up">
                    <img src="{{ asset($service['img']) }}" alt="{{ $service['title'] }}"
                        class="w-full h-auto max-h-144 object-cover rounded-lg mb-8">

                    <div class="prose prose-lg max-w-none">
                        <p class="text-gray-700 text-lg">{{ $service['intro_p1'] }}</p>
                        <p class="text-gray-700 text-lg">{{ $service['intro_p2'] }}</p>

                        <h2 class="text-3xl pt-4 text-gray-700 font-bold">Therapy Benefits</h2>
                        <p class="text-gray-700 text-xl">Therapy offers a path to greater self-awareness, emotional
                            balance and resilience.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 my-12">
                        @foreach ($service['benefit_cards'] as $card)
                            <div class="bg-white p-6 rounded-lg flex items-start gap-4 border border-gray-200 shadow-lg transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
                                data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">

                                <svg class="w-8 h-8 text-teal-500 mt-1 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-1 text-xl">{{ $card['title'] }}</h4>
                                    <p class="text-gray-600">{{ $card['desc'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="prose prose-lg max-w-none">
                        <h2 class="text-3xl text-gray-700 font-bold">How It Works</h2>
                        <p>Our process begins with understanding your unique experiences and goals. Through tailored
                            sessions, we use proven techniques to address your challenges and foster growth.</p>
                    </div>

                    <div class="flex flex-col md:flex-row gap-8 mt-8">
                        @foreach ($service['steps'] as $step)
                            <div class="flex gap-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 150 }}">
                                <div class="text-5xl bg-teal-600 font-bold px-3 py-8 rounded-2xl m-auto text-gray-200">
                                    0{{ $loop->iteration }}
                                </div>
                                <div>
                                    <h4 class="uppercase text-lg font-semibold text-gray-800 mb-2">{{ $step['title'] }}
                                    </h4>
                                    <p class="text-gray-600">{{ $step['desc'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </main>

            </div>
        </div>
    </section>

    <x-home.book />

</x-home.app>
