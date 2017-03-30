<?php
/*************************************************************************************************
 * Copyright 2017 JPL TSolucio, S.L. -- This file is a part of TSOLUCIO coreBOS Tests.
 * The MIT License (MIT)
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software
 * and associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute,
 * sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all copies or
 * substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT
 * NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *************************************************************************************************/

class testcbSettings extends PHPUnit_Framework_TestCase {

	/**
	 * Method testcbSettingsAll
	 * @test
	 */
	public function testcbSettingsAll() {
		$actual = coreBOS_Settings::SettingExists('cbSettingsTest');
		$this->assertFalse($actual,'testcbSettings not exist');
		$actual = coreBOS_Settings::getSetting('cbSettingsTest');
		$this->assertNull($actual,'testcbSettings not exist so null returned');
		// create
		$actual = coreBOS_Settings::setSetting('cbSettingsTest','testvalue');
		$actual = coreBOS_Settings::SettingExists('cbSettingsTest');
		$this->assertTrue($actual,'testcbSettings exist');
		$actual = coreBOS_Settings::getSetting('cbSettingsTest');
		$this->assertEquals('testvalue',$actual,'testcbSettings get value');
		global $adb;
		$adb->query("update cb_settings set setting_value='testcache' where setting_key='cbSettingsTest'");
		$actual = coreBOS_Settings::getSetting('cbSettingsTest');
		$this->assertEquals('testvalue',$actual,'testcbSettings get value from cache');
		// delete
		$actual = coreBOS_Settings::delSetting('cbSettingsTest');
		$actual = coreBOS_Settings::SettingExists('cbSettingsTest');
		$this->assertFalse($actual,'testcbSettings not exist after delete');
		$actual = coreBOS_Settings::getSetting('cbSettingsTest');
		$this->assertNull($actual,'testcbSettings not exist so null returned after delete');
	}

}