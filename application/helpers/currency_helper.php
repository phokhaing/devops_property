<?php 

function currency_format($currency_id="", $money="") {
  if(empty($currency_id) || empty($money)){
    return 0;
  }
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('*');
    $ci->db->where('id', $currency_id);
    $row = $ci->db->get('loan_currency')->row();

    if($row->rounding_mode === 'NAT'){
      $number = $money;
      $result =  floor($number*100)/100;
      // $result = number_format($number, $row->DecimalPlace, $row->decimal_separator, $row->ThousandSeparator);
      return $row->sign." ".$result;
    }
    elseif ($row->rounding_mode === 'UP' || $row->rounding_mode === 'DOWN') {
        $number = round($money, $row->decimal_place);
      	$result = number_format($number, $row->decimal_place, $row->decimal_separator, $row->thousand_separator);
      	return $row->sign." ".$result;
    }
    else {
      $pow = pow ( 10, $row->decimal_place );
      $result = ( ceil ( $pow * $money ) + ceil ( $pow * $money - ceil ( $pow * $money ) ) ) / $pow;
      return $row->sign." ".$result;
    }
    return $row;
}

function currency_format_without_sign($currency_id, $money){

    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('*');
    $ci->db->where('id', $currency_id);
    $row = $ci->db->get('loan_currency')->row();
    if(!empty($row)){
      if($row->rounding_mode === 'NAT'){
        $number = $money;
        // $result = round($number, $row->DecimalPlace, PHP_ROUND_HALF_DOWN);
        $result = number_format($number, $row->decimal_place, $row->decimal_separator, "");
        return $result;
      }
      elseif ($row->rounding_mode === 'UP' || $row->rounding_mode === 'DOWN') {
        $number = round($money, $row->decimal_place);
        $result = number_format($number, $row->decimal_place, $row->decimal_separator, "");
        return $result;
      }
      else {
        $pow = pow ( 10, $row->decimal_place );
        $result = ( ceil ( $pow * $money ) + ceil ( $pow * $money - ceil ( $pow * $money ) ) ) / $pow;
        return $result;
      }
    }
    return $row;
}
function convert_number_to_words($number){

  $hyphen      = '-';
  $conjunction = '  ';
  $separator   = ' ';
  $negative    = 'negative ';
  $decimal     = ' point ';
  $dictionary  = array(
    0                   => 'សូន្យ',
    1                   => 'មួយ',
    2                   => 'ពីរ',
    3                   => 'បី',
    4                   => 'បួន',
    5                   => 'ប្រាំ',
    6                   => 'ប្រាំមួយ',
    7                   => 'ប្រាំពីរ',
    8                   => 'ប្រាំបី',
    9                   => 'ប្រាំបួន',
    10                  => 'ដប់',
    11                  => 'ដប់មួយ',
    12                  => 'ដប់ពីរ',
    13                  => 'ដប់បី',
    14                  => 'ដប់បួន',
    15                  => 'ដប់ប្រាំ',
    16                  => 'ដប់ប្រាំមួយ',
    17                  => 'ដប់ប្រាំពីរ',
    18                  => 'ដប់ប្រាំបី',
    19                  => 'ដប់ប្រាំបួន',
    20                  => 'ម្ភៃ',
    30                  => 'សាមសិប',
    40                  => 'សែសិប​',
    50                  => 'ហាសិប',
    60                  => 'ហុកសិប',
    70                  => 'ចិតសិប',
    80                  => 'ប៉ែតសិប',
    90                  => 'កៅសិប',
    100                 => 'រយ',
    1000                => 'ពាន់',
    1000000             => 'លាន',
  );

  if (!is_numeric($number)) {
    return false;
  }

  if ($number < 0) {
    return $negative . convert_number_to_words(abs($number));
  }

  $string = $fraction = null;

  if (strpos($number, '.') !== false) {
    list($number, $fraction) = explode('.', $number);
  }

  switch (true) {
    case $number < 21:
      $string = $dictionary[$number];
      break;
    case $number < 100:
      $tens   = ((int) ($number / 10)) * 10;
      $units  = $number % 10;
      $string = $dictionary[$tens];
      if ($units) {
        $string .= $hyphen . $dictionary[$units];
      }
      break;
    case $number < 1000:
      $hundreds  = $number / 100;
      $remainder = $number % 100;
      $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
      if ($remainder) {
        $string .= $conjunction . convert_number_to_words($remainder);
      }
      break;
    default:
      $baseUnit = pow(1000, floor(log($number, 1000)));
      $numBaseUnits = (int) ($number / $baseUnit);
      $remainder = $number % $baseUnit;
      $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
      if ($remainder) {
        $string .= $remainder < 100 ? $conjunction : $separator;
        $string .= convert_number_to_words($remainder);
      }
      break;
  }

  if (null !== $fraction && is_numeric($fraction)) {
    $string .= $decimal;
    $words = array();
    foreach (str_split((string) $fraction) as $number) {
      $words[] = $dictionary[$number];
    }
    $string .= implode('', $words);
  }

  return $string;
}
function get_freqency_type($freqType){
  if(!empty($freqType)){
    if($freqType === 'W'){
      return 'សប្ដាហ៍';
    }else if($freqType === 'H'){
      return 'កន្លះឆ្នាំ';
    }else if($freqType === 'F'){
      return 'ពីរសប្ដាហ៍';
    }else if($freqType === 'H'){
      return 'កន្លះឆ្នាំ';
    }else if($freqType === 'Q'){
      return 'បីឆ្នាំ';
    }else if($freqType === 'Y'){
      return 'ឆ្នាំ';
    }else if($freqType === 'O'){
      return 'ផ្សេងៗ';
    }
  }
}

function getloanContract_Currency($loanContractID){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('Currency');
    $ci->db->where('LoanContractID', $loanContractID);
    $row = $ci->db->get('loancontract')->row();

    if(count($row) > 0){
      return $row->Currency;
    }else {
      return "N/A";
    }
}

function round_currency($amount,$currency){
  if($currency === 'KHR'){
    return round($amount,-2);
  }else{
    return $amount;
  }
}



 ?>