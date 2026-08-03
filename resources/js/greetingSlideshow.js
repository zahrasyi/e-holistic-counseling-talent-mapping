import Alpine from "alpinejs";

Alpine.data("greetingSlideshow", () => ({
    currentIndex: 0,
    images: [
        { src: "/asset/homepage/foto-grup-1b.png", alt: "Counselor Team 1" },
        { src: "/asset/homepage/foto-grup2a.png", alt: "Counselor Team 2" },
    ],
    intervalId: null,

    startSlideshow() {
        this.intervalId = setInterval(() => {
            this.currentIndex = (this.currentIndex + 1) % this.images.length;
        }, 5000);
    },
    destroy() {
        clearInterval(this.intervalId);
    },
}));

Alpine.data("historySlideshow", () => ({
    currentIndex: 0,
    images: [
        { src: "asset/history/history1.jpg", alt: "History 1" },
        { src: "asset/history/history2.jpg", alt: "History 2" },
        { src: "asset/history/history3.jpg", alt: "History 3" },
        { src: "asset/history/history4.jpg", alt: "History 4" },
        { src: "asset/history/history5.jpg", alt: "History 5" },
        { src: "asset/history/history6.jpg", alt: "History 6" },
        { src: "asset/history/history7.jpg", alt: "History 7" },
    ],
    startSlideshow() {
        setInterval(() => {
            this.currentIndex = (this.currentIndex + 1) % this.images.length;
        }, 5000);
    },
}));
