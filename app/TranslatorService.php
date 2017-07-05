<?php
namespace Logbook\App;

class TranslatorService
{
	protected $lang = null;
	
	public function translate($frase)
	{
		$lang = $this->loadLanguage();
		if (isset($lang->$frase)) {
			return $lang->$frase;
		} else {
			$this->lang->$frase = $frase;
			$split = $this->split($frase);
			$outstr = [];
			foreach ($split as $word) {
				if (isset($lang->$word)) {
					$outstr []= $lang->$word;
				} else {
					$outstr []= $word;
					$this->lang->$word = $word;
				}
			}
			$this->saveLanguage();
			$this->lang = null;
			return implode(' ', $outstr);
		}
	}
	protected function loadLanguage()
	{
		if ($this->lang == null) {
			$filename = config('locations.language-dir') . '/' . config('app.language') . '.json';
			if (file_exists($filename)) {
				$this->lang = json_decode(file_get_contents($filename));
			} else {
				$this->lang = json_decode('{}');
				$this->saveLanguage();
			}
		}
		
		return $this->lang;
	}
	protected function saveLanguage()
	{
		$filename = config('locations.language-dir') . '/' . config('app.language') . '.json';
		file_put_contents($filename, iconv('Cp1252', 'utf-8', json_encode($this->lang, JSON_PRETTY_PRINT)));
	}
	protected function split($frase)
	{
		return explode(' ', $frase);
	}
}
?>