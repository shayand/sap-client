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
     * InsuranceCertificate constructor.
     * @param String $card_code
     * @param String $insurance_type
     * @param String $insurer
     * @param String $item_code
     * @param String $item_name
     * @param int $payable_amount
     */
    public function __construct($card_code, $insurance_type, $insurer, $item_code, $item_name, $payable_amount)
    {
        $this->card_code = $card_code;
        $this->insurance_type = $insurance_type;
        $this->insurer = $insurer;
        $this->item_code = $item_code;
        $this->item_name = $item_name;
        $this->payable_amount = $payable_amount;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $send_params = [
            'RegiterType' => 'w',
            'CardCode' => $this->card_code,
            'InsuranceType' => $this->insurance_type,
            'Insurer' => $this->insurer,
            'ItemCode' => $this->item_code,
            'ItemName' => $this->item_name,
            'AmountPayable' => $this->payable_amount
        ];
        return $send_params;
    }

}