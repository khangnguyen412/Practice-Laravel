<?php

namespace App\Http\Controllers\Lecture20;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ControllerLecture20 extends Controller
{
    public function get_form()
    {
        return view('lecture20.view-lecture20');
    }

    public function validations_form(Request $request)
    {
        /**
         *  - Import thư viện Illuminate\Support\Facades\Validator
         *  - Cú pháp Validator::make
         */
        /**
         *  - Các rule: 
         *  + required: trường bắt buộc phải nhập.
         *  + email: kiểm tra định dạng email hợp lệ.
         *  + min:[value] và max:[value]: áp dụng cho chuỗi (độ dài ký tự) hoặc số (giá trị số).
         *  + unique:table,column: kiểm tra giá trị phải là duy nhất trong bảng và cột được chỉ định.
         *  + confirmed: yêu cầu trường xác nhận (ví dụ: password_confirmation) phải khớp với trường được xác nhận.
         *  + integer, numeric, boolean: xác thực kiểu dữ liệu: số nguyên, số thực hoặc boolean.
         *  + string: kiểm tra giá trị phải là chuỗi.
         *  + date, before, after: xác thực định dạng ngày và so sánh ngày.
         *  + nullable: cho phép trường đó có giá trị là null.
         */
        $valid_data = Validator::make(
            $request->all(),
            [
                'username'      => 'required|min:5|max:255',
                'email'         => 'required|email',
                'phone'         => 'required|numeric',
                'city'          => 'required|max:255',
            ],
            [
                'required'      => ':attribute không được để trống',
                'min'           => ':attribute không được nhập ít hơn :min',
                'max'           => ':attribute không được nhập nhiêu hơn :max',
                'integer'       => ':attribute chỉ được nhập số',
            ],
            [
                'username'      => 'Tên đăng nhập',
                'email'         => 'Email',
                'phone'         => 'Số điện thoại',
                'city'          => 'Thành phố',
            ],
        );

        /**
         *  - Các method của validator:
         *  + passes(): Kiểm tra dữ liệu có hợp lệ hay không. Trả về true nếu tất cả các rule đều thỏa mãn.
         *  + fails(): Kiểm tra xem dữ liệu có vi phạm bất kỳ rule nào không. Trả về true nếu có lỗi.
         *  + errors(): Lấy danh sách lỗi dạng MessageBag. Cho phép hiển thị lỗi cho từng field.
         *  + validated(): Trả về mảng dữ liệu đã được xác thực. Chỉ có khi validate thành công, dùng trong lớp Form Request.
         *  + sometimes(): Cho phép thêm rule conditionally cho các field.
         *  + failed(): Trả về mảng các rule đã bị vi phạm cho mỗi field.
         */
        if ($valid_data->fails()){
            $errors = json_encode($valid_data->errors(), JSON_UNESCAPED_UNICODE);
            return response($errors)->header('Content-Type', 'application/json; charset=UTF-8');
        }
        if ($valid_data->passes()){
            $result = json_encode($valid_data->validated(), JSON_UNESCAPED_UNICODE);
            return response($result)->header('Content-Type', 'application/json; charset=UTF-8');
        }
        
    }
}
