<?php

/*
 * Formdin Framework
 * Copyright (C) 2012 Ministério do Planejamento
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
 * Este arquivo é parte do Framework Formdin.
 *
 * O Framework Formdin é um software livre; você pode redistribuí-lo e/ou
 * modificá-lo dentro dos termos da GNU LGPL versão 3 como publicada pela Fundação
 * do Software Livre (FSF).
 *
 * Este programa é distribuído na esperança que possa ser útil, mas SEM NENHUMA
 * GARANTIA; sem uma garantia implícita de ADEQUAÇÃO a qualquer MERCADO ou
 * APLICAÇÃO EM PARTICULAR. Veja a Licença Pública Geral GNU/LGPL em português
 * para maiores detalhes.
 *
 * Você deve ter recebido uma cópia da GNU LGPL versão 3, sob o título
 * "LICENCA.txt", junto com esse programa. Se não, acesse <http://www.gnu.org/licenses/>
 * ou escreva para a Fundação do Software Livre (FSF) Inc.,
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
	* Metódo construtor
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
	* Retorna o CPF CNPJ sem formatação
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