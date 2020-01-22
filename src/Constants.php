<?php


namespace shayand\sapClient;


class Constants
{
    private $InsuranceType = [
        'third-party-insurance'=> ['sapKey' => 10 , 'sapLabel' => 'بیمه شخص ثالث'],
        'special-insurance'=> ['sapKey' => 100 , 'sapLabel' => 'بیمه خاص'],
        'travel-insurance'=> ['sapKey' => 110 , 'sapLabel' => 'بیمه مسافرتی'],
        'organizational-health-insurance'=> ['sapKey' =>  120, 'sapLabel' => 'بیمه درمان گروهی'],
        'device-electronic-insurance'=> ['sapKey' => 130 , 'sapLabel' => 'بیمه لوازم الکترونیک، موبایل، تبلت'],
        'damage-insurance'=> ['sapKey' => 140 , 'sapLabel' => 'بیمه حوادث'],
        'auto-body-insurance'=> ['sapKey' => 20 , 'sapLabel' => 'بیمه حوادث'],
        'supplementary-health-insurance'=> ['sapKey' => 30 , 'sapLabel' => 'بیمه درمان انفرادی'],
        'fire-insurance'=> ['sapKey' => 40 , 'sapLabel' => 'بیمه آتش سوزی'],
        'life-insurance'=> ['sapKey' => 70 , 'sapLabel' => 'بیمه عمر'],
        'freight-insurance'=> ['sapKey' => 80 , 'sapLabel' => 'بیمه باربری'],
        'engineering-insurance'=> ['sapKey' => 90 , 'sapLabel' => 'بیمه مهندسی']
    ];

    const Insurer = [
        100 => 'بیمه آسیا',
        110 => 'بیمه پاسارگاد',
        120 => 'بیمه ایران',
        130 => 'بیمه دانا',
        140 => 'بیمه پارسیان',
        150 => 'بیمه البرز',
        160 => 'بیمه معلم',
        170 => 'بیمه ملت',
        180 => 'بیمه نوین',
        190 => 'بیمه سامان',
        200 => 'بیمه سرمد',
        210 => 'بیمه رازی',
        220 => 'بیمه تعاون',
        230 => 'بیمه آسماری',
    ];

    private static $thirdpartyItemCode = [
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

}