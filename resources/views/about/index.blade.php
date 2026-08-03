<x-home.app>
    <section class="relative py-14 bg-unida-blue " data-aos="fade-up">
        <div class="relative text-center container mx-auto px-4">
            <h1 class="text-5xl font-bold text-white mb-2">
                About Our Counseling Service
            </h1>
        </div>
    </section>

    <section class="bg-slate-100 py-10">

        <div class="container mx-auto px-4 max-w-5xl ">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

                <div data-aos="fade-left" data-aos-delay="200">
                    <p class="text-lg font-medium text-gray-500 mb-2">
                        <span class="text-unida-blue mr-2">•</span>Vision & Mission
                    </p>
                    <h3 class="text-4xl font-bold text-gray-800 leading-tight mb-6">Guiding Minds, Healing Hearts,
                        Finding Peace</h3>
                    <p class="text-gray-600 leading-relaxed mb-8">
                        At our mental therapy and counseling center, we are dedicated to guiding individuals on a
                        journey toward inner peace and resilience.
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-8 border-t">
                        <div>
                            <h4 class="text-xl font-semibold text-unida-blue mb-3">Our Vision</h4>
                            <p class="text-gray-600">To become a high-quality and meaningful web-based E-Holistic
                                Counseling institution grounded in Islamic biopsychosocial theory for the health and
                                happ iness of the ummah.</p>
                        </div>
                        <div>
                            <h4 class="text-xl font-semibold text-unida-blue mb-3">Our Mission</h4>
                            <ul class="space-y-2 text-gray-600">
                                <li class="flex items-start gap-2">
                                    <svg class="w-5 h-5 text-teal-500 mt-1 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>To provide high-quality and meaningful web-based counseling services grounded
                                        in Islamic biopsychosocial theory for the health and happiness of the
                                        ummah.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <svg class="w-5 h-5 text-teal-500 mt-1 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>To offer holistic, integrated, and applicable web-based counseling services
                                        for academics, practitioners, and Islamic educational institutions, especially
                                        within the environment of Universitas Darussalam.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div x-data="profileSlideshow()" x-init="startSlideshow()"
                    class="relative lg:w-[500px] lg:h-[500px] lg:aspect-auto  rounded-lg overflow-hidden shadow-xl"
                    data-aos="fade-right">
                    <template x-for="(image, index) in images" :key="index">
                        <div class="absolute inset-0 w-full h-full transition-opacity duration-1000 ease-in-out"
                            :class="{ 'opacity-100': currentIndex === index, 'opacity-0': currentIndex !== index }">
                            <img :src="image.src" :alt="image.alt" class="w-full h-full object-cover">
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </section>


    <section>
        <div x-data="bannerSlideshow()" x-init="startSlideshow()"
            class="lg:w-[600px] mx-auto lg:h-[400px] lg:aspect-auto rounded-lg h-[400px] mt-30 w-full overflow-hidden"
            data-aos="zoom-out">
            <template x-for="(image, index) in images" :key="index">
                <div class="absolute inset-0 flex rounded-lg shadow-xl justify-center items-center transition-opacity duration-1000 ease-in-out"
                    :class="{ 'opacity-100': currentIndex === index, 'opacity-0': currentIndex !== index }">

                    <img :src="image.src" :alt="image.alt" class="h-full w-auto object-cover">

                </div>
            </template>
        </div>
    </section>

    <section class="bg-white py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">

                <div class="mb-12" data-aos="fade-up">
                    <p class="text-lg font-medium text-gray-500 mb-2">
                        <span class="text-unida-blue mr-2">•</span>Management
                    </p>
                    <h2 class="text-3xl font-bold text-teal-600">
                        Management & Implementation
                    </h2>
                </div>

                <div class="text-lg text-gray-600 text-justify leading-relaxed space-y-6" data-aos="fade-up"
                    data-aos-delay="200">
                    <p class="font-semibold text-gray-800">Service Management Structure</p>
                    <p>The implementation of guidance and counseling services at UNIDA is managed by the Guidance and
                        Counseling Division, which falls under the Directorate of Islamic Boarding Schools (DKP).</p>
                    <p>The Rector and Vice Rector III have the authority to formulate policies and strategic direction
                        for this service, ensuring that each counseling program aligns with the university's vision and
                        mission and the Islamic boarding school campus life. The policies include:</p>
                    <ol class="list-decimal space-y-4 pl-7">
                        <li><strong>Determination of service standards:</strong><br>
                            ensures that all counseling
                            activities are conducted in accordance with the principles of professionalism and Islamic
                            values.</li>
                        <li><strong>Drafting regulations:</strong><br>regulates implementation mechanisms, counselor
                            codes
                            of ethics, and student data confidentiality systems.</li>
                        <li><strong>Periodic evaluation:</strong><br>
                            monitors the effectiveness of services and adapts them
                            to student needs over time.</li>
                    </ol>
                    <p>To support service operations, the guidance and counseling department has prepared several
                        essential elements:</p>
                    <ol class="list-decimal space-y-4 pl-7">
                        <li><strong>Counselor Team:</strong><br> consists of professionals in psychology, guidance and
                            counseling, and Islamic education.</li>
                        <li><strong>Digital System (E-Counseling):</strong><br> provides an online platform that makes
                            it
                            easy for students to register, schedule, and consult with counselors.</li>
                        <li><strong>Inter-unit Coordination:</strong><br> collaborates with faculties, academic
                            departments,
                            and student organizations.</li>
                        <li><strong>Development of preventive programs:</strong><br> such as seminars, training, and
                            workshops that are preventative in nature.</li>
                    </ol>
                    <p>With this governance, the implementation of guidance and counseling at Darussalam Gontor
                        University runs in a <strong>structured, integrated, and sustainable manner</strong>, supporting
                        student development from the academic, personal, social, and spiritual aspects.</p>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-white py-20">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-12" data-aos="fade-up">
                <p class="text-lg font-medium text-gray-500 mb-2">
                    <span class="text-unida-blue mr-2">•</span>Our Team
                </p>
                <h2 class="text-4xl font-bold text-gray-900">Dedicated Experts Supporting Your Journey</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @forelse ($counselors as $counselor)
                    <a href="{{ route('about.show', $counselor) }}" class="block group">
                        <div class="text-center" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            @php
                                $photoPath = optional($counselor->counselor)->profile_photo_path;
                                $photoUrl = !empty($photoPath)
                                    ? Storage::url($photoPath)
                                    : 'https://www.gravatar.com/avatar/?d=mp&s=128';
                            @endphp
                            <img class="w-36 h-36 rounded-full mx-auto mb-4 object-cover shadow-lg transition-transform duration-300 hover:scale-105"
                                src="{{ $photoUrl }}" alt="Photo of {{ $counselor->name }}">
                            <h4 class="text-lg font-semibold text-gray-800">{{ $counselor->name }}</h4>
                            <p class="text-gray-500">{{ $counselor->counselorDetail->specialization ?? 'Counselor' }}
                            </p>
                        </div>
                    </a>
                @empty
                    <p class="col-span-full text-center text-gray-500" data-aos="fade-up">Our team of counselors will be
                        featured here soon.</p>
                @endforelse
            </div>
        </div>
    </section>

    <x-home.book />

</x-home.app>
