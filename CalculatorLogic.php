<?php


class CalculatorLogic
{
    /**
     * To hold base price
     * @var float
     */
    public $basePrice;

    /**
     * To hold commission amount
     * @var float
     */
    public $commission;

    /**
     * To hold tax amount
     * @var float|int
     */
    public $tax;

    /**
     * To hold payments when user paying in instalments.
     * @var array
     */
    public $payments;

    /**
     * To hold car value amount
     * @var float|int
     */
    public $value;

    /**
     * set calculator properties value, basePrice, tax and payments
     * @param array $posts
     * @throws Exception
     */
    public function __construct(array $posts)
    {
        if (!$posts['estimatedValue']) {
            throw new Exception('Estimated value of the car is required');
        } else {
            $this->value = (int)$posts['estimatedValue'];
            $dayOfWeek = date("l");
            $timeOfDay = date("g:i a");
            $surgeOpeningTime = strtotime("3:00 pm");
            $surgeClosingTime = $surgeOpeningTime + (5 * 60 * 60);
            $currentTime = strtotime($timeOfDay);
            if($dayOfWeek == 'Friaday' && $currentTime >= $surgeOpeningTime && $currentTime <= $surgeClosingTime) {
                $this->basePrice = $this->value * 0.13;
            } else {
                $this->basePrice = $this->value * 0.11;
            }
        }

        $this->commission = $this->basePrice * 0.17;

        if (!$posts['tax'] && $posts['tax'] != 0) {
            throw new Exception('Tax percentage is required');
        } else {
            $this->tax = $posts['tax'] / 100 * $this->basePrice;
        }

        $this->payments = $this->calculatePayments($posts['instalments']);
    }

    /**
     * Calculate different payments separately
     * @param int $instalments
     * @return array
     */
    protected function calculatePayments(int $instalments = 1) : array
    {
        if ($instalments == 1) {
            return [];
        }

        $payments = [];
        $base = round($this->basePrice / $instalments, 2);
        $commission = round($this->commission / $instalments, 2);
        $tax = round($this->tax / $instalments, 2);

        for ($i = 0; $i < $instalments; $i++) {
            if ($i == $instalments - 1) {
                $base = round($this->basePrice - ($base * ($instalments - 1)), 2);
                $commission = round($this->commission - ($commission * ($instalments - 1)), 2);
                $tax = round($this->tax - ($tax * ($instalments - 1)), 2);
            }
            $total = $base + $commission + $tax;

            $payments[$i] = [
                'base_price' => $base,
                'commission' => $commission,
                'tax' => $tax,
                'total' => $total
            ];
        }

        return $payments;
    }

    /**
     * Convert object to array
     * @return array
     */
    public function toArray() : array
    {
        return [
            'base_price' => round($this->basePrice),
            'commission' => round($this->commission),
            'tax' => round($this->tax),
            'total' => round($this->basePrice + $this->commission + $this->tax, 2),
            'value' => round($this->value),
            'payments' => $this->payments
        ];
    }

    /**
     * Convert object to json-string
     * @return string
     */
    public function toJson() : string
    {
        return json_encode($this->toArray(), http_response_code(200));
    }
}