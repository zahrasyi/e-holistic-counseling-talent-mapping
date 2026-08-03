<!-- Main modal -->
<div id="tinjau-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-lg">
        <div class="px-6 py-4 border-b flex justify-between items-center">
            <div>
                <h3 class="text-xl font-bold">Tinjau Permintaan</h3>
                <p class="text-sm text-gray-500">Dari:
                    <span id="modal-student" class="font-semibold"></span>
                </p>
            </div>
            <button type="button" data-modal-hide="tinjau-modal" class="text-gray-400 hover:text-gray-600">✕</button>
        </div>

        <div class="p-6">
            <form id="modal-form" method="POST">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-sm font-medium">Jadwal Diajukan</label>
                    <p id="modal-time" class="text-lg font-semibold"></p>
                </div>

                <button type="submit" name="action" value="approve"
                    class="mt-4 w-full bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-lg">
                    ✅ Setujui Jadwal Ini
                </button>

                <div class="relative flex items-center my-4">
                    <div class="flex-grow border-t"></div>
                    <span class="px-3 text-xs text-gray-500">atau</span>
                    <div class="flex-grow border-t"></div>
                </div>

                <div>
                    <label for="counselor_proposed_time"
                        class="block text-sm font-medium text-gray-600 dark:text-gray-400 mb-1">
                        Ajukan Waktu Baru
                    </label>
                    <input type="datetime-local" name="counselor_proposed_time" id="counselor_proposed_time"
                        class="block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white text-sm p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" />
                    <button type="submit" name="action" value="propose_new_time"
                        class="mt-3 w-full inline-flex justify-center items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm px-5 py-3 shadow-md transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Ajukan Waktu Baru
                    </button>
                </div>

                <div class="mt-6 flex justify-between items-center border-t pt-4">
                    <button type="submit" name="action" value="reject" class="text-red-600 hover:text-red-800">Tolak
                        Permintaan</button>
                    <button type="button" data-modal-hide="tinjau-modal"
                        class="text-gray-500 hover:text-gray-700">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll("[data-modal-toggle='tinjau-modal']").forEach(button => {
        button.addEventListener("click", function() {
            let student = this.dataset.student;
            let time = this.dataset.time;
            let url = this.dataset.url;

            // isi modal
            document.getElementById("modal-student").textContent = student;
            document.getElementById("modal-time").textContent = new Date(time).toLocaleString('id-ID');

            // set form action dinamis
            document.getElementById("modal-form").setAttribute("action", url);
        });
    });
</script>
