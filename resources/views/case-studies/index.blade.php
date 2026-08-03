<x-home.app>
    <section class="relative py-14 bg-unida-blue " data-aos="fade-up">
        <div class="relative  container mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold text-white mb-2">
                Case Study
            </h1>
            <p class="text-gray-300">
                <a href="{{ route('home') }}" class="text-teal-400 hover:underline">Home</a>
                <span class="mx-2">/</span>
                <span>Services</span>
            </p>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="container max-w-6xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

                @foreach ($caseStudies as $case)
                    <div class="bg-stone-100 rounded-xl overflow-hidden shadow-md transition-all duration-300 hover:-translate-y-2 hover:shadow-xl"
                        data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">

                        <a href="{{ route('case-studies.show', $case['id']) }}">
                            <img class="w-full h-64 object-cover" src="{{ asset($case['img']) }}"
                                alt="{{ $case['title'] }}">
                        </a>

                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">
                                <a href="{{ route('case-studies.show', $case['id']) }}"
                                    class="hover:text-unida-blue">{{ $case['title'] }}</a>
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                                {{ $case['desc'] }}
                            </p>
                            <a href="{{ route('case-studies.show', $case['id']) }}"
                                class="inline-block font-semibold text-teal-600 hover:text-unida-blue group">
                                Learn More
                                <span class="transition-transform duration-300 group-hover:ml-1">&rarr;</span>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
</x-home.app>
