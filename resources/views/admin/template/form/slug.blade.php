<div class="form-group">
    <label>{{ $item['label'] }}</label>
    <input autocomplete="off" value="{{ @$old_record[$item['name']] }}" class="form-control {{ $item['name'] }}"
           type="text" name="{{ $item['name'] }}">
</div>

<script>
    var inputName = document.querySelector(".name");
    var inputSlug = document.querySelector(".{{ $item['name'] }}");

    inputName.addEventListener("change",function(){
        var t = this.value;
        t = ChangeToSlug(t);
        inputSlug.value = t;
        console.log(inputSlug.value);
    });
    function ChangeToSlug(select_nguon) {
        var title, str;
        // Chuyển hết sang chữ thường
        str = select_nguon;
        str = str.toLowerCase();

        // Đổi ký tự có dấu thành không dấu
        str = str.replace(/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/g, 'a');
        str = str.replace(/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/g, 'e');
        str = str.replace(/(ì|í|ị|ỉ|ĩ)/g, 'i');
        str = str.replace(/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/g, 'o');
        str = str.replace(/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/g, 'u');
        str = str.replace(/(ỳ|ý|ỵ|ỷ|ỹ)/g, 'y');
        str = str.replace(/(đ)/g, 'd');

        // Xóa ký tự đặc biệt
        str = str.replace(/([^0-9a-z-\s])/g, '');

        // Xóa khoảng trắng thay bằng ký tự -
        str = str.replace(/(\s+)/g, '-');

        // xóa phần dự - ở đầu
        str = str.replace(/^-+/g, '');

        // xóa phần dư - ở cuối
        str = str.replace(/-+$/g, '');

        // return
        return str;
    }

</script>
