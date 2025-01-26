<x-bootstrap-theme title="procase form">
    <div class="container">
        <h2>แบบฟอร์มสมัครทุนการศึกษา</h2>
        <form action="{{ route('procase.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">ชื่อ นามสกุล</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">ที่อยู่</label>
                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">อายุ</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01"
                    value="{{ old('price') }}">
                @error('price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">อัปโหลดรูปภาพประจำตัว</label>
                <input type="file" class="form-control" id="image" name="image">
                @error('image')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
        </form>
    </div>

</x-bootstrap-theme>
