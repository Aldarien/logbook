<?php
use Carbon\Carbon;

class CLI
{
	public static function parse($data)
	{
		if (is_array($data[0])) {
			foreach ($data as $line) {
				$str = '';
				$c = 0;
				foreach ($line as $field => $value) {
					if ($c > 0) {
						$str .= ' ';
					}
					$str .= $field . ': ' . $value;
					$c ++;
				}
				self::output($str);
			}
		} else {
			$str = '';
			foreach ($data as $c => $value) {
				if ($c > 0) {
					$str .= ' ';
				}
				$str .= $value;
			}
			self::output($str);
		}
	}
	protected static function output($line)
	{
		fwrite(STDOUT, $line);
	}
	public static function menu($params = null)
	{
		if ($params) {
			switch ($params['section']) {
				case 'base':
					$output = ['(1).AddFutureEvent', '(2).AddPastEvent', '(3).FinishFutureEvent', '(4).CheckLastDay'];
					$today = Carbon::today(config('app.timezone'));
					if (isset($params['day']) and $params['day'] < $today->timestamp) {
						$output []= '(5).CheckNextDay';
					}
			}
		} else {
			$output = ['(1).AddFutureEvent', '(2).AddPastEvent', '(3).FinishFutureEvent', '(4).CheckLastDay'];
		}
		$output []= '(E)xit';
		$output []= PHP_EOL . '> ';
		self::parse($output);
	}
	public static function command($command, $params)
	{
		if ($params) {
			switch ($params['section']) {
				case 'base':
					switch ($command) {
						case '1':
							$params['section'] = 'add_future';
							break;
						case '2':
							$params['section'] = 'add_past';
							break;
						case '3':
							$params['section'] = 'finish';
							break;
						default:
							$params['section'] = 'base';
						case '4':
							if (isset($params['day'])) {
								$date = Carbon::createFromTimestamp($params['day'], config('app.timezone'))->subDay();
							} else {
								$date = Carbon::yesterday(config('app.timezone'));
							}
							$params['day'] = $date->timestamp;
							break;
						case '5':
							$date = Carbon::createFromTimestamp($params['day'], config('app.timezone'))->addDay();
							$params['day'] = $date->timestamp;
							break;
					}
					break;
			}
		} else {
			switch ($command) {
				case '1':
					$params['section'] = 'add_future';
					break;
				case '2':
					$params['section'] = 'add_past';
					break;
				case '3':
					$params['section'] = 'finish';
					break;
				case '4':
					if (isset($params['day'])) {
						$date = Carbon::createFromTimestamp($params['day'], config('app.timezone'))->subDay();
					} else {
						$date = Carbon::yesterday(config('app.timezone'));
					}
					$params['day'] = $date->timestamp;
					$params['section'] = 'base';
					break;
				case '5':
					$date = Carbon::createFromTimestamp($params['day'], config('app.timezone'))->addDay();
					$params['day'] = $date->timestamp;
					$params['section'] = 'base';
					break;
				default:
					$params['section'] = 'base';
			}
		}
		
		return $params;
	}
}
?>