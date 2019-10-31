<?php
namespace CONTROLLER\BASE;

class Controller {

    public function __construct(\Request $request) {
        if($request->requestMethod === "POST") {
            $this->validateCSRFField();
        }
    }

    private function validateCSRFField() {
        
        if(!isset($_POST["CSRF-TOKEN"])) {
            header("location: /");
        }

        try {

            if(!hash_equals(\SESSION\Session::get("CSRF/TOKEN"), $_POST['CSRF-TOKEN'])) {
                header("location: /");
            }

        } catch (\Exception $exception) {
            exit($exception);
        }
        
    }

}