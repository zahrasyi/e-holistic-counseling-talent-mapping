<x-layouts.app>
    <x-partials.breadcrumbs :items="$breadcrumbs" />

    <x-partials.header title="Kuesioner"
        description="Silakan lengkapi kuesioner berikut untuk mengetahui jenis layanan yang paling sesuai dengan kebutuhan Anda." />

    <div class="questionnaire-container">
        <div id="step1" class="questionnaire-step">
            <h2 class="text-lg font-semibold text-center">(1 dari 4) Kuisioner Kesehatan Biologis Islami
            </h2>
            <br>
            <x-questionnaire.question name="biologi[1]"
                text="1. Saya menjaga kebersihan diri dan lingkungan sebagai bagian dari iman." />
            <x-questionnaire.question name="biologi[2]"
                text="2. Saya makan makanan yang halal, thayyib, dan bergizi secara teratur." />
            <x-questionnaire.question name="biologi[3]"
                text="3. Saya menjaga keseimbangan tidur, istirahat, dan aktivitas harian." />
            <x-questionnaire.question name="biologi[4]"
                text="4. Saya rutin melakukan olahraga ringan atau aktivitas fisik untuk kesehatan." />
            <x-questionnaire.question name="biologi[5]"
                text="5. Saya menjaga adab saat makan, minum, dan berpakaian sesuai sunnah." />
            <x-questionnaire.question name="biologi[6]"
                text="6. Saya menghindari konsumsi yang membahayakan tubuh (rokok, junk food, dll)." />
            <x-questionnaire.question name="biologi[7]"
                text="7. Saya berusaha menjaga stamina agar bisa beribadah dengan optimal." />
            <x-questionnaire.question name="biologi[8]"
                text="8. Saya menjalani pemeriksaan kesehatan bila dibutuhkan tanpa menunda-nunda." />
            <x-questionnaire.question name="biologi[9]"
                text="9. Saya menjaga aurat dan kebersihan pakaian setiap saat." />
            <x-questionnaire.question name="biologi[10]"
                text="10. Saya memahami bahwa menjaga tubuh adalah bentuk syukur dan amanah dari Allah." />
        </div>
        <div id="step2" class="questionnaire-step">
            <h2 class="text-lg font-semibold text-center">(2 dari 4) Kuisioner Kesehatan Psikologis
                Islami</h2>
            <br>
            <x-questionnaire.question name="psikologi[1]"
                text="1. Saya mampu mengelola emosi marah, kecewa, dan sedih secara proporsional." />
            <x-questionnaire.question name="psikologi[2]"
                text="2. Saya tidak mudah stres atau panik ketika menghadapi masalah." />
            <x-questionnaire.question name="psikologi[3]"
                text="3. Saya merasa optimis dan percaya bahwa Allah akan memberi jalan keluar." />
            <x-questionnaire.question name="psikologi[4]"
                text="4. Saya bisa memaafkan orang lain dan tidak menyimpan dendam." />
            <x-questionnaire.question name="psikologi[5]"
                text="5. Saya berusaha berpikir positif (husnuzan) terhadap orang lain dan takdir." />
            <x-questionnaire.question name="psikologi[6]"
                text="6. Saya memiliki semangat dan tujuan hidup yang jelas karena Allah." />
            <x-questionnaire.question name="psikologi[7]"
                text="7. Saya merasa cukup dan bersyukur atas apa yang Allah berikan." />
            <x-questionnaire.question name="psikologi[8]"
                text="8. Saya merasa tenang setelah berdoa dan curhat kepada Allah." />
            <x-questionnaire.question name="psikologi[9]"
                text="9. Saya menerima kekurangan diri dengan lapang dada dan tetap berusaha lebih baik." />
            <x-questionnaire.question name="psikologi[10]"
                text="10. Saya menjaga akhlak dalam perasaan dan pikiran, agar tidak menzalimi diri sendiri." />
        </div>
        <div id="step3" class="questionnaire-step">
            <h2 class="text-lg font-semibold text-center">(3 dari 4) Kuisioner Kesehatan Sosial Islami
            </h2>
            <br>
            <x-questionnaire.question name="sosial[1]"
                text="1. Saya memiliki hubungan sosial yang positif dengan teman dan lingkungan." />
            <x-questionnaire.question name="sosial[2]"
                text="2. Saya mampu berkomunikasi dengan baik dan sopan dalam pergaulan." />
            <x-questionnaire.question name="sosial[3]"
                text="3. Saya merasa nyaman dan diterima dalam kelompok sosial saya." />
            <x-questionnaire.question name="sosial[4]"
                text="4. Saya berpartisipasi aktif dalam kegiatan sosial, baik formal maupun informal." />
            <x-questionnaire.question name="sosial[5]"
                text="5. Saya peduli dan membantu teman/orang lain yang membutuhkan." />
            <x-questionnaire.question name="sosial[6]"
                text="6. Saya menghindari konflik sosial yang tidak perlu dan mampu menyelesaikannya dengan bijak." />
            <x-questionnaire.question name="sosial[7]"
                text="7. Saya menjalin hubungan sosial dengan niat karena Allah dan ukhuwah Islamiyah." />
            <x-questionnaire.question name="sosial[8]"
                text="8. Saya menjaga lisan dan sikap agar tidak menyakiti orang lain." />
            <x-questionnaire.question name="sosial[9]"
                text="9. Saya bisa bersikap adil dan tidak memihak saat terjadi perselisihan." />
            <x-questionnaire.question name="sosial[10]"
                text="10. Saya meneladani akhlak Nabi Muhammad ﷺ dalam bermasyarakat." />
        </div>
        <div id="step4" class="questionnaire-step">
            <h2 class="text-lg font-semibold text-center">(4 dari 4) Kuisioner Kesehatan Spiritual
                Islami</h2>
            <br>
            <x-questionnaire.question name="spiritual[1]"
                text="1. Saya menjaga shalat lima waktu tepat waktu dan dengan kekhusyukan." />
            <x-questionnaire.question name="spiritual[2]"
                text="2. Saya memperbanyak dzikir, istighfar, dan doa dalam keseharian." />
            <x-questionnaire.question name="spiritual[3]"
                text="3. Saya merasa dekat dengan Allah dalam suka maupun duka." />
            <x-questionnaire.question name="spiritual[4]"
                text="4. Saya merasa tenang ketika membaca atau mendengarkan Al-Qur’an." />
            <x-questionnaire.question name="spiritual[5]"
                text="5. Saya menghindari maksiat walau kecil karena takut kepada Allah." />
            <x-questionnaire.question name="spiritual[6]"
                text="6. Saya menjadikan niat karena Allah sebagai dasar dari semua aktivitas." />
            <x-questionnaire.question name="spiritual[7]"
                text="7. Saya bersyukur atas nikmat sekecil apa pun dan bersabar atas ujian." />
            <x-questionnaire.question name="spiritual[8]"
                text="8. Saya merasa terdorong untuk memperbaiki diri ketika lalai terhadap Allah." />
            <x-questionnaire.question name="spiritual[9]"
                text="9. Saya berusaha menjaga hubungan baik dengan sesama sebagai bentuk ibadah." />
            <x-questionnaire.question name="spiritual[10]"
                text="10. Saya meneladani akhlak Rasulullah ﷺ dalam kehidupan sehari-hari." />
        </div>
    </div>

</x-layouts.app>
