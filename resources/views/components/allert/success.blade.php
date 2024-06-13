@if (@session('success'))
        <div id="alert-success" class="bg-green-100 border border-green-400 text-green-700 px-3 py-4 my-2 mx-3 rounded relative" role="alert">
            {{ session('success') }}
        </div>
@endif

<script>
    // Script untuk menghapus pesan kesalahan setelah 3 detik
    setTimeout(function(){
        var alertDanger = document.getElementById('alert-success');
        if (alertDanger) {
            alertDanger.remove();
        }
    }, 3000); // 3000 milidetik = 3 detik
</script>