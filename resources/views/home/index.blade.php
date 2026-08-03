<x-home.app>

    <section class="relative py-14 bg-unida-blue " data-aos="fade-up">
        <div class="relative text-center container mx-auto px-4">
            <h1 class="text-5xl font-bold text-white mb-2">
                Find Your Best Psychic Advisor
            </h1>
        </div>
    </section>

    <section class="bg-slate-100 pt-16 items-center">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center max-w-5xl mx-auto" data-aos="fade-up">

                <div x-data="greetingSlideshow()" x-init="startSlideshow()"
                    class="relative rounded-lg overflow-hidden shadow-xl w-full aspect-square lg:w-[500px] lg:h-[500px] lg:aspect-auto">
                    <template x-for="(image, index) in images" :key="index">
                        <div class="absolute inset-0 w-full h-full transition-opacity duration-1000 ease-in-out"
                            :class="{ 'opacity-100': currentIndex === index, 'opacity-0': currentIndex !== index }">
                            <img :src="image.src" :alt="image.alt" class="w-full h-full object-cover">
                        </div>
                    </template>
                </div>

                <div class="text-gray-700">
                    <p class="text-lg font-medium text-gray-500-400 mb-2">
                        <span class="text-unida-blue mr-2">•</span>Greeting
                    </p>
                    <h2 class="text-4xl font-semibold text-gray-800 leading-tight mb-5">
                        Assalāmuʿalaikum <br> warahmatullāhi wabarakātuh.
                    </h2>
                    <p class="text-gray-600  leading-loose mb-8">
                        Welcome to E-Holistic at the University of Darussalam Gontor (UNIDA), a means of psychological
                        support and student guidance that integrates modern <i>'ilm an-nafs'</i> (self-knowledge) with
                        Islamic values, based on monotheism, noble character, and oriented towards
                        <strong><i>tazkiyatun-nafs</i></strong>.
                    </p>

                    <div class="flex items-center gap-4">
                        <a href="#"
                            class="inline-block bg-unida-blue text-white px-8 py-3 rounded-full font-semibold shadow-lg hover:bg-blue-800 transition-colors duration-300">
                            Learn More
                        </a>
                        <a href="#"
                            class="inline-block bg-transparent border-2 border-gray-400 text-gray-700 px-8 py-3 rounded-full font-semibold hover:bg-gray-700 hover:text-white transition-colors duration-300">
                            Get in touch
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section>
        <div x-data="historySlideshow()" x-init="startSlideshow()"
            class="lg:w-[600px] mx-auto lg:h-[600px] lg:aspect-auto rounded-lg h-[400px] mt-30 w-full overflow-hidden"
            data-aos="zoom-out">
            <template x-for="(image, index) in images" :key="index">
                <div class="absolute inset-0 flex rounded-lg shadow-xl justify-center items-center transition-opacity duration-1000 ease-in-out"
                    :class="{ 'opacity-100': currentIndex === index, 'opacity-0': currentIndex !== index }">

                    <img :src="image.src" :alt="image.alt" class="h-full w-auto object-cover">

                </div>
            </template>
        </div>
    </section>

    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-5xl mx-auto">

                <div class="mb-6" data-aos="fade-up">
                    <p class="text-lg font-medium text-gray-500 mb-2">
                        <span class="text-unida-blue mr-2">•</span>History of the Development of
                    </p>
                    <h2 class="text-3xl font-bold text-teal-600">
                        E-Holistic Counseling at UNIDA Gontor
                    </h2>
                </div>

                <div class="text-lg text-gray-600 text-justify leading-relaxed space-y-6" data-aos="fade-up"
                    data-aos-delay="200">
                    <p class="indent-14">The inspiration behind the development of the Web-Based E-Holistic Counseling
                        Model with the
                        Islamic Biopsychosocial Theory at Universitas Darussalam Gontor stems from the actual need for
                        an integrative and modern counseling system that remains firmly grounded in Islamic values. The
                        research team, consisting of four (Jarman Arroisi, Usmanul Khakim, Amilia Yuni Damayanti, dan
                        Widya Kurniawan) lecturers, hopes that this book/program will serve as both a conceptual and
                        practical guideline for academics, practitioners, and Islamic educational institutions in
                        designing counseling services that are holistic in their biological, psychological, social, and
                        spiritual dimensions.</p>
                    <p class="indent-14">The development of E-Holistic Counseling within the environment of Universitas
                        Darussalam (UNIDA)
                        Gontor is a necessity. The transformation of counseling services from conventional methods (from
                        2021 to 2025) to digital platforms is driven not only by technological advancement but also by
                        the increasing complexity of students’ problems. Therefore, this counseling development
                        emphasizes the importance of Islamic-based solutions capable of nurturing students who are
                        well-balanced in their physical, mental, spiritual, and social aspects.</p>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-white py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12" data-aos="fade-up">
                    <p class="text-lg font-medium text-gray-500 mb-2">
                        <span class="text-unida-blue mr-2">•</span>Our Graduate
                    </p>
                    <h2 class="text-4xl font-bold text-gray-900">
                        Graduate Profile of Islamic E-Holistic Counseling
                    </h2>
                    <span class="block text-xl font-medium text-gray-500 mt-2">
                        University of Darussalam Gontor
                    </span>
                </div>

                <div class="text-lg text-gray-600 leading-relaxed text-justify space-y-6" data-aos="fade-up">
                    <p>
                        Graduates of the Islamic E-Holistic Counseling Program at Universitas Darussalam Gontor are
                        expected to possess multidimensional competencies that reflect the integration of modern
                        counseling sciences, Islamic values, and technological proficiency in delivering web-based
                        counseling services. They are not only professional counselors but also visionary social change
                        agents with noble character.
                    </p>
                    <p class="font-semibold text-gray-700">
                        Key Characteristics of Graduates:
                    </p>

                    <ol class="list-decimal  text-justify px-6 space-y-2">
                        <li>
                            <strong class="font-semibold text-gray-800">Islamic Character and God-Consciousness
                                (Taqwa).</strong><br>
                            Graduates demonstrate a strong personality grounded in Islamic adab (etiquette), deep faith,
                            and piety towards Allah SWT. Counseling is viewed as a means of enhancing spiritual strength
                            and Islamic morals.
                        </li>
                        <li>
                            <strong class="font-semibold text-gray-800">Mastery of the Islamic Biopsychosocial
                                Theory.</strong><br>
                            Competent in understanding and applying the Islamic biopsychosocial framework in assessing,
                            analyzing, and addressing counseling issues holistically and integratively.
                        </li>
                        <li>
                            <strong class="font-semibold text-gray-800">Expertise in Web-Based Counseling
                                Technology.</strong><br>
                            Skilled in utilizing digital technologies to conduct professional, secure, and effective
                            online counseling services, and capable of developing innovative Islamic e-counseling
                            platforms.
                        </li>
                        <li>
                            <strong class="font-semibold text-gray-800">Competent in Addressing the Complex Challenges
                                of Modern Students.</strong><br>
                            Able to resolve contemporary student issues encompassing biological, psychological, social,
                            and spiritual aspects using shar’i-compliant, systemic, and solution-oriented approaches.
                        </li>
                        <li>
                            <strong class="font-semibold text-gray-800">Socially and Educationally
                                Responsive.</strong><br>
                            Responsive to the dynamics and needs of academic communities, educational institutions, and
                            the wider society, with the ability to collaborate across disciplines to support
                            psychosocial well-being.
                        </li>
                        <li>
                            <strong class="font-semibold text-gray-800">Visionary, Adaptive, and Transformative
                                Counselor.</strong><br>
                            Possesses forward-thinking perspectives, adaptability to the changing times, and the
                            capacity to bring about positive transformation through an integrative Islamic counseling
                            model rooted in revelation and scientific reasoning.
                        </li>
                    </ol>

                </div>
            </div>
        </div>
    </section>

    <section class="bg-stone-50 py-20" x-data="timeline()">
        <div class="container max-w-5xl mx-auto px-4" data-aos="fade-up">

            <div class="mb-24 max-w-2xl">
                <p class="text-lg font-medium text-gray-500 mb-2">
                    <span class="text-unida-blue mr-2">•</span>How It Works
                </p>
                <h2 class="text-4xl font-bold text-gray-900 leading-tight">
                    Guiding You Through Our Therapy Process
                </h2>
            </div>
            <div class="relative">
                <div class="grid grid-cols-1 gap-y-28 pt-8 lg:grid-cols-4 lg:gap-x-8" data-aos="fade-up">

                    <template x-for="(step, index) in steps" :key="index">
                        <div class="relative text-center h-48">
                            <div class="absolute left-1/2 -translate-x-1/2 w-[90px] h-[90px] bg-unida-drab text-white rounded-xl flex items-center justify-center text-5xl font-semibold z-20"
                                :class="index % 2 === 0 ? 'top-0' : 'bottom-0'">
                                <span x-text="step.number"></span>
                            </div>

                            <div class="absolute left-1/2 -translate-x-1/2 w-full px-2"
                                :class="index % 2 === 0 ? 'top-[105px]' : 'bottom-[105px]'">
                                <h4 class="uppercase text-sm font-semibold text-gray-800 mb-2" x-text="step.title"></h4>
                                <p class="text-sm text-gray-500" x-text="step.description"></p>
                            </div>

                            <div x-show="index < steps.length - 1"
                                class="hidden lg:block absolute z-10 border-t-2 border-dashed border-gray-400 w-3/4 transform origin-left"
                                :class="{
                                    'top-[45px] left-1/2 ml-[57px] rotate-[35deg]': index % 2 === 0,
                                    'bottom-[45px] left-1/2 ml-[57px] -rotate-[35deg]': index % 2 !== 0
                                }">
                            </div>
                        </div>
                    </template>

                </div>
            </div>
        </div>
    </section>

    <x-home.book />

</x-home.app>