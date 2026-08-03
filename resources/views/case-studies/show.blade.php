<x-home.app>
    <section class="relative py-16" data-aos="fade-in">
        <div class="absolute inset-0">
            <img src="{{ asset($caseStudy['banner_img']) }}" alt="{{ $caseStudy['title'] }}"
                class="w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 bg-unida-blue"></div>
        </div>
        <div class="relative container mx-auto px-4">
            <h1 class="text-5xl font-bold text-white mb-2" data-aos="fade-up" data-aos-delay="100">
                {{ $caseStudy['title'] }}
            </h1>
            <p class="text-gray-300" data-aos="fade-up" data-aos-delay="200">
                <a href="{{ route('home') }}" class="text-teal-400 hover:underline">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('case-studies') }}" class="text-teal-400 hover:underline">Case Studies</a>
                <span class="mx-2">/</span>
                <span>{{ $caseStudy['title'] }}</span>
            </p>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <article class="max-w-4xl mx-auto">
                <img src="{{ asset($caseStudy['img']) }}" alt="{{ $caseStudy['title'] }}"
                    class="w-full h-auto rounded-lg mb-8" data-aos="fade-up">

                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mt-8 mb-4" data-aos="fade-up">Introduction</h2>
                    <p class="text-lg text-gray-600 leading-relaxed" data-aos="fade-up">{{ $caseStudy['introduction'] }}
                    </p>

                    <h2 class="text-3xl font-bold text-gray-900 mt-8 mb-4" data-aos="fade-up">Therapeutic Approach</h2>
                    <p class="text-lg text-gray-600 leading-relaxed" data-aos="fade-up">{!! $caseStudy['approach'] !!}</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 my-12">
                    @foreach ($caseStudy['points'] as $point)
                        <div class="bg-slate-100 p-6 rounded-lg shadow-sm" data-aos="fade-up"
                            data-aos-delay="{{ $loop->index * 100 }}">
                            <h3 class="text-lg font-semibold text-unida-blue mb-2">{{ $point['title'] }}</h3>
                            <p class="text-gray-600">{{ $point['desc'] }}</p>
                        </div>
                    @endforeach
                </div>

                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mt-8 mb-4" data-aos="fade-up">Progress and Outcome</h2>
                    <p class="text-lg text-gray-600 leading-relaxed" data-aos="fade-up">{{ $caseStudy['outcome'] }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center my-12">
                    <ul class="list-disc pl-5 space-y-2 text-lg text-gray-600" data-aos="fade-right">
                        @foreach ($caseStudy['progress']['outcomes'] as $outcome)
                            <li>{{ $outcome }}</li>
                        @endforeach
                    </ul>
                    <img src="{{ asset($caseStudy['progress']['image']) }}" alt="Progress illustration"
                        class="rounded-lg w-full h-10 object-cover lg:w-[500px] lg:h-[300px]" data-aos="fade-left">
                </div>

                <div class="mt-16" x-data="{ activeFaq: null }" data-aos="fade-up">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Frequently Asked Questions</h2>
                    <div class="space-y-4">
                        @foreach ($caseStudy['faqs'] as $index => $faq)
                            <div class="border rounded-lg overflow-hidden">
                                <button
                                    @click="activeFaq = activeFaq === {{ $index }} ? null : {{ $index }}"
                                    class="w-full flex justify-between items-center text-left p-4 focus:outline-none">
                                    <span class="font-semibold text-gray-800">{{ $faq['q'] }}</span>
                                    <svg class="w-5 h-5 text-gray-500 transition-transform duration-300 transform"
                                        :class="{ 'rotate-180': activeFaq === {{ $index }} }" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <div x-show="activeFaq === {{ $index }}" x-collapse
                                    class="p-4 pt-0 text-gray-600">
                                    <p>{{ $faq['a'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </article>
        </div>
    </section>

    <section class="py-20">
        <div class="container max-w-5xl mx-auto px-4">
            <div class="bg-gradient-to-br from-rose-100 to-cyan-100 rounded-[30px] p-12 lg:p-16" data-aos="fade-up">
                <div class="flex flex-col lg:flex-row items-center text-center lg:text-left gap-10">

                    <div class="flex-shrink-0">
                        <img class="w-[180px] h-auto rounded-full" src="{{ asset('asset/homepage/ilustrasi.png') }}"
                            alt="Book a therapy session illustration">
                    </div>

                    <div>
                        <p class="text-lg font-medium text-gray-600 mb-2">
                            <span class="text-unida-blue mr-2">•</span>Join Today
                        </p>
                        <h2 class="text-3xl font-bold text-gray-900 mb-4">
                            Book a Therapy Session and Begin Thriving
                        </h2>
                        <p class="text-gray-700 mb-8 max-w-xl mx-auto lg:mx-0">
                            Schedule your appointment now and start building the life you deserve.
                        </p>
                        <a href="#"
                            class="inline-block bg-white text-teal-600 border border-teal-600 px-8 py-3 rounded-full font-semibold shadow-lg transition duration-300 hover:bg-teal-600 hover:text-white">
                            Book an Appointment
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
</x-home.app>
