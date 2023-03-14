<?php


namespace App\Validate;


use Illuminate\Http\Request;

class Validate
{
    private $message = [];

    public function validate(Request $request, ApiValidateInterface $validatorClass): array
    {
        $validator = $validatorClass->rules($request);

        if($validator->errors()->count() > 0) {
            $this->addInMessage($validator->errors()->toArray());
        }

        return $this->getMessage();
    }

    private function addInMessage(array $errors): void
    {
        $fails = [];
        foreach ($errors as $key => $message) {
            $fails[$key][] = $message[0];
        }

        $this->message = [
            "success" => false,
            "message" => "Validation failed",
            "fails" => $fails
        ];
    }

    /**
     * @return array
     */
    private function getMessage(): array
    {
        return $this->message;
    }
}
