import Alpine from "alpinejs";

Alpine.data("bannerSlideshow", () => ({
    currentIndex: 0,
    images: [
        { src: "asset/about/banner1.jpg", alt: "About Us Banner 1" },
        { src: "asset/about/banner3.jpg", alt: "About Us Banner 2" },
        { src: "asset/about/banner2.jpg", alt: "About Us Banner 3" },
    ],
    startSlideshow() {
        setInterval(() => {
            this.currentIndex = (this.currentIndex + 1) % this.images.length;
        }, 3000);
    },
}));

Alpine.data("profileSlideshow", () => ({
    currentIndex: 0,
    images: [
        { src: "asset/about/profiles1.png", alt: "Counselor Profile 1" },
        { src: "asset/about/profiles2.png", alt: "Counselor Profile 2" },
        { src: "asset/about/profiles3.png", alt: "Counselor Profile 3" },
        { src: "asset/about/profiles4.png", alt: "Counselor Profile 4" },
    ],
    startSlideshow() {
        setInterval(() => {
            this.currentIndex = (this.currentIndex + 1) % this.images.length;
        }, 3000);
    },
}));
