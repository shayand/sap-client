<?php


namespace shayand\sapClient;


class InsuranceCertificate
{

    /**
     * @var string $RegiterType
     */
    private $RegiterType =  'w';

    /**
     * @var String $card_code
     */
    private $card_code;

    /**
     * @var String $insurance_type
     */
    private $insurance_type;

    /**
     * @var String $insurer
     */
    private $insurer;

    /**
     * @var String $item_code
     */
    private $item_code;

    /**
     * @var String $item_name
     */
    private $item_name;

    /**
     * @var integer $payable_amount
     */
    private $payable_amount;

    /**
     * @var String $card_name
     */
    private $card_name;

    /**
     * InsuranceCertificate constructor.
     * @param String $card_code
     * @param String $card_name
     * @param Constants $constants
     * @param int $payable_amount
     * @throws Exception\InvalidInsuranceConstantException
     */
    public function __construct($card_code, $card_name, Constants $constants, $payable_amount)
    {
        $this->card_code = $card_code;
        $constant_array = $constants->toArray();

        $this->insurance_type = $constant_array['insuranceType']['sapKey'];
        $this->insurer = $constant_array['insurer']['sapKey'];
        $this->item_code = $constant_array['item']['itemCode'];
        $this->item_name = $constant_array['item']['itemName'];
        $this->payable_amount = $payable_amount;
        $this->card_name = $card_name;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $send_params = [
            'RegiterType' => 'w',
            'CardCode' => $this->card_code,
            'CardName' => $this->card_name,
            'InsuranceType' => $this->insurance_type,
            'Insurer' => $this->insurer,
            'ItemCode' => $this->item_code,
            'ItemName' => $this->item_name,
            'AmountPayable' => $this->payable_amount
        ];
        return $send_params;
    }

}