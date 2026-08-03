<x-home.app>
    <section class="relative py-14 bg-unida-blue " data-aos="fade-up">
        <div class="relative  container mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold text-white mb-2">
                Our Services
            </h1>
            <p class="text-gray-300">
                <a href="{{ route('home') }}" class="text-teal-400 hover:underline">Home</a>
                <span class="mx-2">/</span>
                <span>Services</span>
            </p>
        </div>
    </section>

    <section class="py-20 bg-white w-full">
        <div class="container mx-auto max-w-6xl px-4">
            <div class="max-w-3xl mx-auto text-center mb-12" data-aos="fade-up">
                <p class="text-lg font-medium text-gray-500 mb-2">
                    <span class="text-unida-blue mr-2">•</span>Services
                </p>
                <h2 class="text-4xl font-bold text-gray-900 leading-tight">
                    Comprehensive Care for Mind and Wellness
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($services as $service)
                    <a href="{{ route('services.show', $service['slug']) }}"
                        class="group block rounded-3xl overflow-hidden shadow-lg relative h-72" data-aos="zoom-in"
                        data-aos-delay="{{ $loop->index * 100 }}">

                        <img class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                            src="{{ asset($service['img']) }}" alt="{{ $service['title'] }}">

                        <div
                            class="absolute inset-0 bg-black/40 transition-colors duration-300 group-hover:bg-black/60">
                        </div>

                        <div class="relative h-full flex flex-col justify-end p-6 text-white">
                            <h4 class="text-xl font-bold mb-2">{{ $service['title'] }}</h4>
                            <div class="inline-flex items-center gap-2 font-semibold">
                                Read More
                                <span class="transition-transform duration-300 group-hover:translate-x-1">&rarr;</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-slate-100 w-full py-24">
        <div class="container mx-auto max-w-6xl px-4">

            <div class="lg:w-3/5 mb-16" data-aos="fade-right">
                <p class="text-lg font-medium text-gray-500 mb-2">
                    <span class="text-unida-blue mr-2">•</span>Why Choose Us
                </p>
                <h2 class="text-4xl font-bold text-gray-900 leading-tight mb-4">
                    Trusted Care, Lasting Positive Change
                </h2>
                <p class="text-lg text-gray-600 leading-relaxed">
                    With a commitment to compassionate, evidence-based care, we empower individuals to create lasting
                    positive change in their lives. Our team of experienced therapists provides a supportive and
                    confidential environment.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                <div class="relative h-[500px]" data-aos="fade-right" data-aos-delay="200">
                    <img src="{{ asset('asset/services/mental-health.png') }}" alt="Therapy Session"
                        class="absolute top-0 left-0 w-4/5 h-3/5 object-cover rounded-xl shadow-lg z-10 transition-transform duration-300 hover:scale-105 hover:-rotate-2 hover:z-30">

                    <img src="{{ asset('asset/services/mental-health-1.png') }}" alt="Mental Health Keywords"
                        class="absolute bottom-0 right-0 w-[70%] h-1/2 object-cover rounded-xl shadow-lg z-20 transition-transform duration-300 hover:scale-105 hover:rotate-2 hover:z-30">
                </div>

                <div data-aos="fade-left" data-aos-delay="300">
                    <h3 class="text-3xl font-bold text-gray-900 leading-tight mb-4">
                        Choosing Us for Your Mental Wellness
                    </h3>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Choosing us for your mental wellness means partnering with a dedicated team of professionals
                        committed to your growth and healing. Our holistic approach combines evidence-based therapies,
                        personalized support, and a compassionate space to help you navigate life's challenges.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <x-home.book />

</x-home.app>
