<section x-data="slideshow()" x-init="startSlideshow()"
    class="relative mt-20 h-[90vh] flex items-center overflow-hidden bg-gray-200">

    <div class="absolute inset-0 z-0">
        <template x-for="(image, index) in images" :key="index">
            <div class="absolute inset-0 w-full h-full bg-cover bg-top transition-opacity duration-1000 ease-in-out"
                :style="`background-image: url('${image}');`"
                :class="{ 'opacity-100': currentIndex === index, 'opacity-0': currentIndex !== index }"></div>
        </template>
    </div>
</section>


<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('slideshow', () => ({
            currentIndex: 0,
            images: [
                @if (Request::is('/'))
                    '{{ asset('asset/slide/slide-home1.jpg') }}',
                    '{{ asset('asset/slide/slide-home2.jpg') }}',
                @elseif(Request::is('about'))
                   '{{ asset('asset/slide/slide-aboutus1.jpg') }}',
                    '{{ asset('asset/slide/slide-aboutus2.jpg') }}',
                    '{{ asset('asset/slide/slide-aboutus3.jpg') }}',
                    '{{ asset('asset/slide/slide-aboutus4.jpg') }}',
                    '{{ asset('asset/slide/slide-aboutus5.jpg') }}'
                @elseif(Request::is('services'))
                   '{{ asset('asset/slide/slide-service1.jpg') }}',
                    '{{ asset('asset/slide/slide-service2.jpg') }}',
                    '{{ asset('asset/slide/slide-service3.jpg') }}'
                @elseif(Request::is('case-studies'))
                   '{{ asset('asset/slide/slide-casestudy1.jpg') }}',
                    '{{ asset('asset/slide/slide-casestudy2.jpg') }}',
                    '{{ asset('asset/slide/slide-casestudy3.jpg') }}',
                    '{{ asset('asset/slide/slide-casestudy4.jpg') }}'
                @else
                   '{{ asset('asset/slide/slide1.png') }}',
                    '{{ asset('asset/slide/slide2.png') }}'
                @endif
            ],
            intervalId: null,

            startSlideshow() {
                this.intervalId = setInterval(() => {
                    this.nextSlide();
                }, 5000);
            },
            nextSlide() {
                this.currentIndex = (this.currentIndex + 1) % this.images.length;
            },
            destroy() {
                clearInterval(this.intervalId);
            }
        }));
    });
</script>