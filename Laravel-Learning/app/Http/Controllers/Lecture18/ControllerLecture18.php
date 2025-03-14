<?php

namespace App\Http\Controllers\Lecture18;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ControllerLecture18 extends Controller
{
    public function get_form()
    {
        return view('lecture18-19-20.view-lecture18');
    }

    public function handle_request(Request $request)
    {
        $category = $request->get('category');
        if (!empty($category)) {
            switch ($category) {
                case "show-all":
                    /**
                     *  Lấy dữ liệu của form
                     */
                    return $request->all();
                    break;
                case "show-name":
                    /**
                     *  Lấy dữ liệu của field chỉ đinh
                     */
                    return $request->get('name');
                    break;
                case "show-method":
                    /**
                     *  Kiểm tra phương thức gửi
                     */
                    return $request->isMethod('post');
                    break;
                case "show-path":
                    /**
                     *  Lấy path của form
                     */
                    return $request->path();
                case "show-with-only":
                    /**
                     *  Trả về mỗi giá trị của key thuộc only
                     */
                    return $request->only(['username']);
                    break;
                case "show-with-input":
                    /**
                     *  Trả về mỗi giá trị của key với giá trị mặc đinh nếu field đó rỗng
                     */
                    return $request->input('city', 'default');
                    break;
                case "show-with-collection":
                    /**
                     *  Kết hợp với collection();
                     */
                    $input = $request->collect();
                    return $input->take(2)->toArray();
                    break;
                case "show-ip":
                    /**
                     *  Trả về IP request form
                     */
                    return $request->ip();
                    break;
                default:
                    return "sai phương thức";
            }
        } else {
            return $request->all();
        }
    }
}
