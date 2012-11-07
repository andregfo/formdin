<?php

/*
 * Formdin Framework
 * Copyright (C) 2012 Minist�rio do Planejamento
 * ----------------------------------------------------------------------------
 * This file is part of Formdin Framework.
 *
 * Formdin Framework is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public License version 3
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License version 3
 * along with this program; if not,  see <http://www.gnu.org/licenses/>
 * or write to the Free Software Foundation, Inc., 51 Franklin Street,
 * Fifth Floor, Boston, MA  02110-1301, USA.
 * ----------------------------------------------------------------------------
 * Este arquivo � parte do Framework Formdin.
 *
 * O Framework Formdin � um software livre; voc� pode redistribu�-lo e/ou
 * modific�-lo dentro dos termos da GNU LGPL vers�o 3 como publicada pela Funda��o
 * do Software Livre (FSF).
 *
 * Este programa � distribu�do na esperan�a que possa ser �til, mas SEM NENHUMA
 * GARANTIA; sem uma garantia impl�cita de ADEQUA��O a qualquer MERCADO ou
 * APLICA��O EM PARTICULAR. Veja a Licen�a P�blica Geral GNU/LGPL em portugu�s
 * para maiores detalhes.
 *
 * Voc� deve ter recebido uma c�pia da GNU LGPL vers�o 3, sob o t�tulo
 * "LICENCA.txt", junto com esse programa. Se n�o, acesse <http://www.gnu.org/licenses/>
 * ou escreva para a Funda��o do Software Livre (FSF) Inc.,
 * 51 Franklin St, Fifth Floor, Boston, MA 02111-1301, USA.
 */

/**
* Classe para entrada de dados tipo CNPJ
*/
if( !function_exists('__autoload') )
{
	function __autoload($class_name) {
		require_once $class_name . '.class.php';
	}
}
class TCpfCnpj extends TMask
{
	/**
	* Met�do construtor
	*
	* @param string $strName
	* @param string $strValue
	* @param boolean $boolRequired
	* @return TCpfField
	*/
	public function __construct($strName,$strValue=null,$boolRequired=null)
	{
		parent::__construct($strName,$strValue,'',$boolRequired);
		$this->setFieldType('cpfcnpj');
		$this->setEvent('onkeyup','fwFormataCpfCnpj(this,event)');
		$this->setEvent('onblur','fwValidarCpfCnpj(this,event)');
		$this->setSize(19);
	}
	public function getFormated()
	{
		if($this->getValue())
		{
			$value = @preg_replace("/[^0-9]/","",$this->getValue() );
			if( strlen($value) == 11 )
			{
				return substr($value,0,3).".".substr($value,3,3).".".substr($value,6,3)."-".substr($value,9,2);
			}
			else if ( strlen($value) == 14 )
			{
				return substr($value,0,2).".".substr($value,2,3).".".substr($value,5,3)."/".substr($value,8,4)."-".substr($value,12,2);
			}
		}
		return $this->value();
	}

	/**
	* Retorna o CPF CNPJ sem formata��o
	*
	*/
	public function getValue()
	{
		return @preg_replace("/[^0-9]/","",$this->value);
	}
}
/*
$cpfcnpj = new TCpfCnpjField('num_cpf_cnpj','CPF/CNPJ:',true);
$cpfcnpj->show();
*/
?>