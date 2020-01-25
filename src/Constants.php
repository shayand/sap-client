<?php


namespace shayand\sapClient;


use shayand\sapClient\Exception\InvalidInsuranceConstantException;

class Constants
{
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
        'engineering-insurance'=> ['sapKey' => 90 , 'sapLabel' => 'بیمه مهندسی']
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
        'MIC0001' => 'بیمه شخص ثالث بیمه ایران',
        'MIC0002' => 'بیمه شخص ثالث بیمه آسیا',
        'MIC0003' => 'بیمه شخص ثالث بیمه البرز',
        'MIC0004' => 'بیمه شخص ثالث بیمه دانا',
        'MIC0005' => 'بیمه شخص ثالث بیمه سامان',
        'MIC0006' => 'بیمه شخص ثالث بیمه پاسارگاد',
        'MIC0007' => 'بیمه شخص ثالث بیمه پارسیان',
        'MIC0008' => 'بیمه شخص ثالث بیمه معلم',
        'MIC0009' => 'بیمه شخص ثالث بیمه نوین',
        'MIC0010' => 'بیمه شخص ثالث بیمه رازی',
        'MIC0012' => 'بیمه شخص ثالث بیمه ملت',
        'IC2401005' => 'بیمه شخص ثالث آسماری',
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
        'HI0003' => 'بیمه درمان انفرادی'
    ];

    /**
     * Constants constructor.
     * @param string $insuranceType
     * @param string $insurer
     * @param string|null $InsuranceType
     * @throws InvalidInsuranceConstantException
     */
    public function __construct($insuranceType,$insurer,$insuranceProduct = null)
    {
        try{
            $selectedInsuranceType = self::InsuranceType[$insuranceType];
            $selectedInsurer = self::Insurer[$insurer];

            $final = [
                'insuranceType' => $selectedInsuranceType,
                'insurer' => $selectedInsurer,
            ];

            switch ($insuranceType){
                case 'third-party-insurance':
                    $selectedItemCode = array_search($selectedInsurer['sapLabel'],$this->thirdpartyItemCode);
                    $final['item'] = ['itemCode',$selectedItemCode,'itemName' => $selectedInsurer['sapLabel']];
                break;
                case 'auto-body-insurance':
                    $selectedItemCode = array_search($insuranceProduct,$this->autobodyItemCode);
                    $final['item'] = ['itemCode',$selectedItemCode,'itemName' => $insuranceProduct];
                break;
                case 'travel-insurance':
                    $selectedItemCode = array_search($insuranceProduct,$this->travelItemCode);
                    $final['item'] = ['itemCode',$selectedItemCode,'itemName' => $insuranceProduct];
                break;
                case 'fire-insurance':
                    $selectedItemCode = array_search($insuranceProduct,$this->fireInsurance);
                    $final['item'] = ['itemCode',$selectedItemCode,'itemName' => $insuranceProduct];
                break;
                case 'supplementary-health-insurance':
                    $selectedItemCode = array_search($insuranceProduct,$this->cureInsurance);
                    $final['item'] = ['itemCode',$selectedItemCode,'itemName' => $insuranceProduct];
                break;
            }

            return $final;
        } catch (\Exception $exception){
            throw new InvalidInsuranceConstantException($exception->getMessage());
        }

    }

}