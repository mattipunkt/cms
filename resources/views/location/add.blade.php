<x-layout>
<h1>Add Location</h1>
    <form action="/locations/add" method="POST">
        @csrf
        <div class="form-floating mb-3 mt-3">
            <input name="name" type="text" class="form-control" id="name" placeholder="Venue Name" value="">
            <label for="name">Name</label>
        </div>
        <div class="form-floating mb-3 mt-3">
            <input name="address" type="text" class="form-control" id="address" placeholder="Venue Address" value="">
            <label for="adress">Adress (optional)</label>
        </div>
        <button type="submit" class="btn btn-info">
            Save
        </button>


    </form>
</x-layout>
