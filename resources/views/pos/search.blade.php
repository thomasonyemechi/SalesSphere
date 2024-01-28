<style>
    .search-con {
        position: relative;
    }

    .sbox {
        position: absolute;
        z-index: 9;
        max-height: 50vh;
        overflow-y: scroll;
        overflow-x: hidden;
    }
</style>

<div class="form-group search-con">
    <input type="search" id="search" class="form-control py-1" 
        placeholder="Scan Item to add" autofocus >
    <div class="sbox rounded-bottom border shadow bg-white p-2" style="width: 100%; display: none">
    </div>
</div>
