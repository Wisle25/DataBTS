@if ($errors->any())
<div class="w-full my-5" id="alert-danger">
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
        role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<script>
    setTimeout(function(){
        var alertDanger = document.getElementById('alert-danger');
        if (alertDanger) {
            alertDanger.remove();
        }
    }, 3000); 
</script>
