<?php


namespace shayand\sapClient;


use shayand\sapClient\Exception\InvalidInsuranceConstantException;

class Constants
{
    /**
     * @var
     */
    private $insuranceType;
    /**
     * @var
     */
    private $insurer;
    /**
     * @var null
     */
    private $insuranceProduct;

    const InsuranceType = [
        'third-party-insurance'=> ['sapKey' => 10 , 'sapLabel' => 'بیمه شخص ثالث'],
        'special-insurance'=> ['sapKey' => 100 , 'sapLabel' => 'بیمه خاص'],
        'travel-insurance'=> ['sapKey' => 110 , 'sapLabel' => 'بیمه مسافرتی'],
        'organizational-health-insurance'=> ['sapKey' =>  120, 'sapLabel' => 'بیمه درمان گروهی'],
        'device-electronic-insurance'=> ['sapKey' => 130 , 'sapLabel' => 'بیمه لوازم الکترونیک، موبایل، تبلت'],
        'damage-insurance'=> ['sapKey' => 140 , 'sapLabel' => 'بیمه حوادث'],
        'auto-body-insurance'=> ['sapKey' => 20 , 'sapLabel' => 'بیمه بدنه'],
        'supplementary-health-insurance'=> ['sapKey' => 30 , 'sapLabel' => 'بیمه درمان انفرادی'],
        'fire-insurance'=> ['sapKey' => 40 , 'sapLabel' => 'بیمه آتش سوزی'],
        'life-insurance'=> ['sapKey' => 70 , 'sapLabel' => 'بیمه عمر'],
        'freight-insurance'=> ['sapKey' => 80 , 'sapLabel' => 'بیمه باربری'],
        'engineering-insurance'=> ['sapKey' => 90 , 'sapLabel' => 'بیمه مهندسی'],
        'motor-third-party-insurance' => ['sapKey' => 10,'sapLabel' => 'شخص ثالث موتور سیکلت']
    ];

    const Insurer = [
        'iran-insurance' => ['sapKey' => 120,'sapLabel' => 'بیمه ایران'],
        'asia-insurance' => ['sapKey' => 100,'sapLabel' => 'بیمه آسیا'],
        'alborz-insurance' => ['sapKey' => 150,'sapLabel' => 'بیمه البرز'],
        'dana-insurance' => ['sapKey' => 130,'sapLabel' => 'بیمه دانا'],
        'saman-insurance' => ['sapKey' => 190,'sapLabel' => 'بیمه سامان'],
        'pasargad-insurance' => ['sapKey' => 110,'sapLabel' => 'بیمه پاسارگاد'],
        'parsian-insurance' => ['sapKey' => 140,'sapLabel' => 'بیمه پارسیان'],
        'moalem-insurance' => ['sapKey' => 160,'sapLabel' => 'بیمه معلم'],
        'novin-insurance' => ['sapKey' => 180,'sapLabel' => 'بیمه نوین'],
        'razi-insurance' => ['sapKey' => 210,'sapLabel' => 'بیمه رازی'],
        'day-insurance' => ['sapKey' => null,'sapLabel' => 'بیمه دی'],
        'mellat-insurance' => ['sapKey' => 170,'sapLabel' => 'بیمه ملت'],
        'sarmad-insurance' => ['sapKey' => 200,'sapLabel' => 'بیمه سرمد'],
        'taavon-insurance' => ['sapKey' => 220,'sapLabel' => 'بیمه تعاون'],
        'asmari-insurance' => ['sapKey' => 230,'sapLabel' => 'بیمه آسماری'],
    ];

    private $thirdpartyItemCode = [
        'MIC0001' => 'third-party-insurance-iran-insurance',
        'MIC0002' => 'third-party-insurance-asia-insurance',
        'MIC0003' => 'third-party-insurance-alborz-insurance',
        'MIC0004' => 'third-party-insurance-dana-insurance',
        'MIC0005' => 'third-party-insurance-saman-insurance',
        'MIC0006' => 'third-party-insurance-pasargad-insurance',
        'MIC0007' => 'third-party-insurance-parsian-insurance',
        'MIC0008' => 'third-party-insurance-moalem-insurance',
        'MIC0009' => 'third-party-insurance-novin-insurance',
        'MIC0010' => 'third-party-insurance-razi-insurance',
        'MIC0012' => 'third-party-insurance-mellat-insurance',
        'IC2401005' => 'third-party-insurance-asmari-insurance',
    ];

    private $autobodyItemCode = [
        'MO00001' => 'بدنه سواری',
        'MO00002' => 'بدنه اتوکار',
        'MO00003' => 'بدنه بارکش',
        'MO00004' => 'بدنه موتور سیکلت',
        'MO00005' => 'بدنه سواری طرح مهر',
    ];

    private $travelItemCode = [
        'HI0003' => 'مسافرتی'
    ];

    private $fireInsurance = [
        'FI00001' => 'آتش سوزی صنعتی',
        'FI00002' => 'آتش سوزی غیر صنعتی',
        'FI00003' => 'آتش سوزی مسکونی',
    ];

    private $cureInsurance = [
        'HI00001' => 'درمان انفرادی'
    ];

    private $motorInsurance = [
        'M00002' => 'شخص ثالث موتور سیکلت'
    ];

    /**
     * Constants constructor.
     * @param $insuranceType
     * @param $insurer
     * @param null $insuranceProduct
     */
    public function __construct($insuranceType,$insurer,$insuranceProduct = null)
    {

        $this->insuranceType = $insuranceType;
        $this->insurer = $insurer;
        $this->insuranceProduct = $insuranceProduct;
    }

    /**
     * @return array
     * @throws InvalidInsuranceConstantException
     */
    public function toArray()
    {
        try{
            $selectedInsuranceType = self::InsuranceType[$this->insuranceType];
            $selectedInsurer = self::Insurer[$this->insurer];

            $final = [
                'insuranceType' => $selectedInsuranceType,
                'insurer' => $selectedInsurer,
            ];

            switch ($this->insuranceType){
                case 'third-party-insurance':
                    $selectedItemCode = array_search($this->insuranceProduct,$this->thirdpartyItemCode);
                    $final['item'] = ['itemCode' => 'MT00001','itemName' => 'شخص ثالث سواری'];
                    break;
                case 'auto-body-insurance':
//                    $selectedItemCode = array_search($this->insuranceProduct,$this->autobodyItemCode);
                    $final['item'] = ['itemCode' => 'MO00001','itemName' => 'بدنه سواری'];
                    break;
                case 'travel-insurance':
//                    $selectedItemCode = array_search($this->insuranceProduct,$this->travelItemCode);
                    $final['item'] = ['itemCode' => 'HI00003','itemName' => 'مسافرتی'];
                    break;
                case 'fire-insurance':
//                    $selectedItemCode = array_search($this->insuranceProduct,$this->fireInsurance);
                    $final['item'] = ['itemCode' => 'FI00003','itemName' => 'آتش سوزی مسکونی'];
                    break;
                case 'supplementary-health-insurance':
                    $selectedItemCode = array_search($this->insuranceProduct,$this->cureInsurance);
                    $final['item'] = ['itemCode' => $selectedItemCode,'itemName' => $this->insuranceProduct];
                    break;
                case 'motor-third-party-insurance':
                    $final['item'] = ['itemCode' => 'MT00002','itemName' => 'شخص ثالث موتور سیکلت'];
                    break;
            }

            return $final;
        } catch (\Exception $exception){
            throw new InvalidInsuranceConstantException($exception->getMessage());
        }

    }

}