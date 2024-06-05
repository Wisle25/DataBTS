    <!-- Modal for displaying complete data -->
    <div class="modal">
        <div id="detailModal" class="hidden">
            <div class="fixed inset-0 flex items-center justify-center font-sans bg-black bg-opacity-50 ">
                <div class="bg-white p-5 rounded-lg w-1/3">
                <h2 class="text-2xl mb-4 font-nunito font-semibold text-center">Detail {{ $slot }}</h2>
                <div id="modalContent" class="font-sans"></div>
                <div dir="rtl">
                    <button class="ms-auto mt-4 px-8 py-2 bg-yellow-300 text-gray-800 rounded-lg"
                        onclick="closeModal()">Close</button>
                    </div>
            </div>
        </div>
    </div>
</div>