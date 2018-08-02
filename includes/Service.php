<?php

namespace Petschko\DHL;

/**
 * Author: Peter Dragicevic [peter@petschko.org]
 * Authors-Website: http://petschko.org/
 * Date: 26.01.2017
 * Time: 18:18
 * Update: 02.08.2018
 * Version: 0.1.1
 *
 * Notes: Contains the Service Class
 */

use stdClass;

/**
 * Class Service
 */
class Service {
	/**
	 * Contains if the Shipment should delivered on a specific Day
	 *
	 * Note: Optional
	 * Available for:
	 *  ShipmentDetails::PRODUCT_TYPE_SAME_DAY_MESSENGER
	 *  DHL_ShipmentDetails::PRODUCT_TYPE_WISH_TIME_MESSENGER
	 *
	 * @var bool|null $dayOfDeliveryEnabled - Is this enabled | null uses default
	 */
	private $dayOfDeliveryEnabled = null;

	/**
	 * Contains the Day, when the Shipment should be delivered
	 *
	 * Note: Optional|ISO-Date-Format (YYYY-MM-DD)|Required if $dayOfDeliveryEnabled
	 * Available for:
	 *  DHL_ShipmentDetails::PRODUCT_TYPE_SAME_DAY_MESSENGER
	 *  DHL_ShipmentDetails::PRODUCT_TYPE_WISH_TIME_MESSENGER
	 * Min-Len: 10
	 * Max-Len: 10
	 *
	 * @var string|null $dayOfDeliveryDate - Delivery-Date
	 */
	private $dayOfDeliveryDate = null;

	/**
	 * Contains if the Shipment should be delivered on a specific Time-Frame
	 *
	 * Note: Optional
	 * Available for:
	 *  DHL_ShipmentDetails::PRODUCT_TYPE_SAME_DAY_MESSENGER
	 *  DHL_ShipmentDetails::PRODUCT_TYPE_WISH_TIME_MESSENGER
	 *
	 * @var bool|null $deliveryTimeframeEnabled - Is this enabled | null uses default
	 */
	private $deliveryTimeframeEnabled = null;

	/**
	 * Contains the Time-Frame when the Shipment should be delivered
	 *
	 * Note: Optional|Required if $deliveryTimeframeEnabled
	 * Write the Values like this 10:00 - 12:30 => (Correct Value) 10001230
	 * or 9:13 - 10:00 => 09131000
	 * or 16:00 - 19:00 => 16001900
	 * Available for:
	 *  DHL_ShipmentDetails::PRODUCT_TYPE_SAME_DAY_MESSENGER
	 *  DHL_ShipmentDetails::PRODUCT_TYPE_WISH_TIME_MESSENGER
	 * Min-Len: 8
	 * Max-Len: 8
	 *
	 * @var string|null $deliveryTimeframe - Time-Frame for delivery
	 */
	private $deliveryTimeframe = null;

	/**
	 * Contains if preferred delivery Time is enabled
	 *
	 * Note: Optional
	 * Available for:
	 *  DHL_ShipmentDetails::PRODUCT_TYPE_NATIONAL_PACKAGE
	 *  DHL_ShipmentDetails::PRODUCT_TYPE_SAME_DAY_PACKAGE
	 *
	 * @var bool|null $preferredTimeEnabled - Is this enabled | null uses default
	 */
	private $preferredTimeEnabled = null;

	/**
	 * Contains the preferred delivery Time-Frame
	 *
	 * Note: Optional|Required if $preferredTimeEnabled
	 * Write the Values like this 10:00 - 12:30 => (Correct Value) 10001230
	 * or 9:13 - 10:00 => 09131000
	 * or 16:00 - 19:00 => 16001900
	 * Available for:
	 *  DHL_ShipmentDetails::PRODUCT_TYPE_NATIONAL_PACKAGE
	 *  DHL_ShipmentDetails::PRODUCT_TYPE_SAME_DAY_PACKAGE
	 * Min-Len: 8
	 * Max-Len: 8
	 *
	 * @var string|null $preferredTime - Preferred delivery Time-Frame
	 */
	private $preferredTime = null;

	/**
	 * Contains if an individual sender requirement is enabled (and required)
	 *
	 * Note: Optional
	 * Available for:
	 *  DHL_ShipmentDetails::PRODUCT_TYPE_SAME_DAY_MESSENGER
	 *  DHL_ShipmentDetails::PRODUCT_TYPE_WISH_TIME_MESSENGER
	 *
	 * @var bool|null $individualSenderRequirementsEnabled - Is this enabled | null uses default
	 */
	private $individualSenderRequirementsEnabled = null;

	/**
	 * Contains the Requirement (Free text)
	 *
	 * Note: Optional|Required if $individualSenderRequirementsEnabled
	 * Available for:
	 *  DHL_ShipmentDetails::PRODUCT_TYPE_SAME_DAY_MESSENGER
	 *  DHL_ShipmentDetails::PRODUCT_TYPE_WISH_TIME_MESSENGER
	 * Min-Len: 1
	 * Max-Len: 250
	 *
	 * @var string|null $individualSenderRequirementsText - Sender Requirement (Free text) | null for none
	 */
	private $individualSenderRequirementsText = null;

	/**
	 * Contains if Packaging return is enabled
	 *
	 * Note: Optional
	 *
	 * @var bool|null $packagingReturn - Is this enabled | null uses default
	 */
	private $packagingReturn = null;

	/**
	 * Contains if return immediately if the Shipment failed
	 *
	 * Note: Optional
	 * Available for:
	 *  DHL_ShipmentDetails::PRODUCT_TYPE_SAME_DAY_PACKAGE
	 *
	 * @var bool|null $returnImmediatelyIfShipmentFailed - Is this enabled | null uses default
	 */
	private $returnImmediatelyIfShipmentFailed = null;

	/**
	 * Contains if Notice on Non-Deliverable is enabled
	 *
	 * Note: Optional
	 *
	 * @var bool|null $noticeOnNonDeliverable - Is this enabled | null uses default
	 */
	private $noticeOnNonDeliverable = null;

	/**
	 * Contains if Shipment-Handling is enabled
	 *
	 * Note: Optional
	 * Available for:
	 *  DHL_ShipmentDetails::PRODUCT_TYPE_SAME_DAY_MESSENGER
	 *  DHL_ShipmentDetails::PRODUCT_TYPE_WISH_TIME_MESSENGER
	 *
	 * @var bool|null $shipmentHandlingEnabled - Is this enabled | null uses default
	 */
	private $shipmentHandlingEnabled = null;

	/**
	 * Contains the Shipment-Handling Type
	 *
	 * Note: Optional|Required if $shipmentHandlingEnabled
	 * Available for:
	 *  DHL_ShipmentDetails::PRODUCT_TYPE_SAME_DAY_MESSENGER
	 *  DHL_ShipmentDetails::PRODUCT_TYPE_WISH_TIME_MESSENGER
	 * Min-Len: 1
	 * Max-Len: 1
	 *
	 * There are the following types are allowed:
	 * a: Remove content, return box;
	 * b: Remove content, pick up and dispose cardboard packaging;
	 * c: Handover parcel/box to customer ¿ no disposal of cardboar.d/box;
	 * d: Remove bag from of cooling unit and handover to customer;
	 * e: Remove content, apply return label und seal box, return box
	 *
	 * @var string|null $shipmentHandlingType - Shipment-Handling Type
	 */
	private $shipmentHandlingType = null;

	/**
	 * Contains if the Service "Endorsement" is enabled
	 *
	 * Note: Optional
	 *
	 * @var bool|null $endorsementEnabled - Is this enabled | null uses default
	 */
	private $endorsementEnabled = null;

	/**
	 * Contains the Type for the "Endorsement"-Service
	 *
	 * Note: Optional|Required if $endorsementEnabled
	 *
	 * for national:
	 *  SOZU (Return immediately),
	 *  ZWZU (2nd attempt of Delivery);
	 * for International:
	 *  IMMEDIATE (Sending back immediately to sender),
	 *  AFTER_DEADLINE (Sending back immediately to sender after expiration of time),
	 *  ABANDONMENT (Abandonment of parcel at the hands of sender (free of charge))
	 *
	 * @var string|null $endorsementType - Endorsement-Service Type
	 */
	private $endorsementType = null;

	/**
	 * Contains if Age-Check is enabled
	 *
	 * Note: Optional
	 *
	 * @var bool|null $visualCheckOfAgeEnabled - Is this enabled | null uses default
	 */
	private $visualCheckOfAgeEnabled = null;

	/**
	 * Contains the Age that the Receiver should be at least
	 *
	 * Note: Optional|Required if $visualCheckOfAgeEnabled
	 * Min-Len: 3
	 * Max-Len: 3
	 *
	 * There are the following types are allowed:
	 * A16
	 * A18
	 *
	 * @var string|null $visualCheckOfAgeType - Minimum-Age of the Receiver
	 */
	private $visualCheckOfAgeType = null;

	/**
	 * Contains if preferred Location is enabled
	 *
	 * Note: Optional
	 *
	 * @var bool|null $preferredLocationEnabled - Is this enabled | null uses default
	 */
	private $preferredLocationEnabled = null;

	/**
	 * Contains details of the preferred Location (Free text)
	 *
	 * Note: Optional|Required if $preferredLocationEnabled
	 * Min-Len: 1
	 * Max-Len: 100
	 *
	 * @var string|null $preferredLocationDetails - Details of the preferred Location (Free text)
	 */
	private $preferredLocationDetails = null;

	/**
	 * Contains if preferred Neighbour is enabled
	 *
	 * Note: Optional
	 *
	 * @var bool|null $preferredNeighbourEnabled - Is this enabled | null uses default
	 */
	private $preferredNeighbourEnabled = null;

	/**
	 * Contains the details of the preferred Neighbour (Free text)
	 *
	 * Note: Optional|Required if $preferredNeighbourEnabled
	 * Min-Len: 1
	 * Max-Len: 100
	 *
	 * @var string|null $preferredNeighbourText - Details of the preferred Neighbour (Free text)
	 */
	private $preferredNeighbourText = null;

	/**
	 * Contains if preferred Day is enabled
	 *
	 * Note: Optional
	 *
	 * @var bool|null $preferredDayEnabled - Is this enabled | null uses default
	 */
	private $preferredDayEnabled = null;

	/**
	 * Contains the details of the preferred Day (Free text)
	 *
	 * Note: Optional|Required if $preferredDayEnabled
	 * Min-Len: 1
	 * Max-Len: 100
	 *
	 * @var string|null $preferredDayText - Details of the preferred Day (Free text)
	 */
	private $preferredDayText = null;

	/**
	 * Contains if GoGreen is enabled
	 *
	 * Note: Optional|Version 1 ONLY
	 *
	 * @var bool|null $goGreen - Is this enabled | null uses default
	 * @deprecated - DHL-API-Version 1 Field
	 */
	private $goGreen = null;

	/**
	 * Contains if deliver Perishables
	 *
	 * Note: Optional
	 *
	 * @var bool|null $perishables - Is this enabled | null uses default
	 */
	private $perishables = null;

	/**
	 * Contains if personal handover is enabled
	 *
	 * Note: Optional
	 *
	 * @var bool|null $personalHandover - Is this enabled | null uses default
	 * @deprecated - DHL-API-Version 1 Field
	 */
	private $personalHandover = null;

	/**
	 * Contains if Neighbour delivery is disabled
	 *
	 * Note: Optional
	 *
	 * @var bool|null $disableNeighbourDelivery - Is this enabled | null uses default
	 */
	private $disableNeighbourDelivery = null;

	/**
	 * Contains if named Person can only accept delivery
	 *
	 * Note: Optional
	 *
	 * @var bool|null $namedPersonOnly - Is this enabled | null uses default
	 */
	private $namedPersonOnly = null;

	/**
	 * Contains if return receipt is enabled
	 *
	 * Note: Optional
	 *
	 * @var bool|null $returnReceipt - Is this enabled | null uses default
	 */
	private $returnReceipt = null;

	/**
	 * Contains if Premium is enabled (for fast and safe delivery of international shipments)
	 *
	 * Note: Optional
	 *
	 * @var bool|null $premium - Is this enabled | null uses default
	 */
	private $premium = null;

	/**
	 * Contains if cash on delivery is enabled
	 *
	 * Note: Optional
	 *
	 * @var bool|null $cashOnDeliveryEnabled - Is this enabled | null uses default
	 */
	private $cashOnDeliveryEnabled = null;

	/**
	 * Contains if the "AddFee" is enabled
	 * Explanation from DHL: (COD = CashOnDelivery)
	 * Configuration whether the transmission fee to be added to the COD amount or not by DHL.
	 * Select the option then the new COD amount will automatically printed on the shipping label and will transferred
	 * to the end of the day to DHL. Do not select the option and the specified COD amount remains unchanged.
	 *
	 * Note: Optional
	 *
	 * @var bool|null $cashOnDeliveryAddFee - Is this enabled | null uses default
	 */
	private $cashOnDeliveryAddFee = null;

	/**
	 * Contains the Amount how much the receiver must pay
	 * Explanation from DHL: (COD = CashOnDelivery)
	 * Money amount to be collected. Mandatory if COD is chosen.
	 * Attention: Please add the additional 2 EURO transmittal fee when entering the COD Amount
	 *
	 * Note: Optional|Required if $cashOnDeliveryEnabled
	 *
	 * @var float|null $cashOnDeliveryAmount - CashOnDelivery Amount
	 */
	private $cashOnDeliveryAmount = null;

	/**
	 * Contains if the Shipment is insured with a higher standard
	 *
	 * Note: Optional
	 *
	 * @var bool|null $additionalInsuranceEnabled - Is this enabled | null uses default
	 */
	private $additionalInsuranceEnabled = null;

	/**
	 * Contains the Amount with that the Shipment is insured
	 *
	 * Note: Optional|Required if $additionalInsuranceEnabled
	 *
	 * @var float|null $additionalInsuranceAmount - Insure-Amount
	 */
	private $additionalInsuranceAmount = null;

	/**
	 * Contains if you deliver Bulky-Goods
	 *
	 * Note: Optional
	 *
	 * @var bool|null $bulkyGoods - Is this enabled | null uses default
	 */
	private $bulkyGoods = null;

	/**
	 * Contains if the Ident-Check is enabled
	 *
	 * Note: Optional
	 *
	 * @var bool|null $identCheckEnabled - Is this enabled | null uses default
	 */
	private $identCheckEnabled = null;

	/**
	 * Contains the Ident-Check Object
	 *
	 * Note: Optional|Required if $indentCheckEnabled
	 *
	 * @var IdentCheck|null $identCheckObj - Ident-Check Object
	 */
	private $identCheckObj = null;

	/**
	 * Clears Memory
	 */
	public function __destruct() {
		unset($this->dayOfDeliveryEnabled);
		unset($this->dayOfDeliveryDate);
		unset($this->deliveryTimeframeEnabled);
		unset($this->deliveryTimeframe);
		unset($this->preferredTimeEnabled);
		unset($this->preferredTime);
		unset($this->individualSenderRequirementsEnabled);
		unset($this->individualSenderRequirementsText);
		unset($this->packagingReturn);
		unset($this->returnImmediatelyIfShipmentFailed);
		unset($this->noticeOnNonDeliverable);
		unset($this->shipmentHandlingEnabled);
		unset($this->shipmentHandlingType);
		unset($this->endorsementEnabled);
		unset($this->endorsementType);
		unset($this->visualCheckOfAgeEnabled);
		unset($this->visualCheckOfAgeType);
		unset($this->preferredLocationEnabled);
		unset($this->preferredLocationDetails);
		unset($this->preferredNeighbourEnabled);
		unset($this->preferredNeighbourText);
		unset($this->preferredDayEnabled);
		unset($this->preferredDayText);
		unset($this->goGreen);
		unset($this->perishables);
		unset($this->personalHandover);
		unset($this->disableNeighbourDelivery);
		unset($this->namedPersonOnly);
		unset($this->returnReceipt);
		unset($this->premium);
		unset($this->cashOnDeliveryEnabled);
		unset($this->cashOnDeliveryAddFee);
		unset($this->cashOnDeliveryAmount);
		unset($this->additionalInsuranceEnabled);
		unset($this->additionalInsuranceAmount);
		unset($this->bulkyGoods);
		unset($this->identCheckEnabled);
		unset($this->identCheckObj);
	}

	/**
	 * @return bool|null
	 */
	public function getDayOfDeliveryEnabled() {
		return $this->dayOfDeliveryEnabled;
	}

	/**
	 * @param bool|null $dayOfDeliveryEnabled
	 */
	public function setDayOfDeliveryEnabled($dayOfDeliveryEnabled) {
		$this->dayOfDeliveryEnabled = $dayOfDeliveryEnabled;
	}

	/**
	 * @return null|string
	 */
	public function getDayOfDeliveryDate() {
		return $this->dayOfDeliveryDate;
	}

	/**
	 * @param null|int|string $dayOfDeliveryDate - The Day of Delivery as ISO-Date-Format (YYYY-MM-DD) or the day as time() int value
	 * @param bool $useIntTime - Use the int Time Value instead of a String
	 */
	public function setDayOfDeliveryDate($dayOfDeliveryDate, $useIntTime = false) {
		if($useIntTime) {
			$dayOfDeliveryDate = date('Y-m-d', $dayOfDeliveryDate);

			if($dayOfDeliveryDate === false)
				$dayOfDeliveryDate = null;
		}

		$this->dayOfDeliveryDate = $dayOfDeliveryDate;
	}

	/**
	 * @return bool|null
	 */
	public function getDeliveryTimeframeEnabled() {
		return $this->deliveryTimeframeEnabled;
	}

	/**
	 * @param bool|null $deliveryTimeframeEnabled
	 */
	public function setDeliveryTimeframeEnabled($deliveryTimeframeEnabled) {
		$this->deliveryTimeframeEnabled = $deliveryTimeframeEnabled;
	}

	/**
	 * @return null|string
	 */
	public function getDeliveryTimeframe() {
		return $this->deliveryTimeframe;
	}

	/**
	 * @param null|string $deliveryTimeframe
	 */
	public function setDeliveryTimeframe($deliveryTimeframe) {
		$this->deliveryTimeframe = $deliveryTimeframe;
	}

	/**
	 * @return bool|null
	 */
	public function getPreferredTimeEnabled() {
		return $this->preferredTimeEnabled;
	}

	/**
	 * @param bool|null $preferredTimeEnabled
	 */
	public function setPreferredTimeEnabled($preferredTimeEnabled) {
		$this->preferredTimeEnabled = $preferredTimeEnabled;
	}

	/**
	 * @return null|string
	 */
	public function getPreferredTime() {
		return $this->preferredTime;
	}

	/**
	 * @param null|string $preferredTime
	 */
	public function setPreferredTime($preferredTime) {
		$this->preferredTime = $preferredTime;
	}

	/**
	 * Alias for $this->getIndividualSenderRequirementsEnabled()
	 *
	 * @return bool|null
	 *
	 * @deprecated - Invalid name of the function
	 */
	public function getIndividualSenderRequiredmentsEnabled() {
		trigger_error(
			'Called deprecated method ' . __METHOD__ . ': Use getIndividualSenderRequirementsEnabled() instead, this method will removed in the future!',
			E_USER_DEPRECATED
		);

		return $this->getIndividualSenderRequirementsEnabled();
	}

	/**
	 * Alias for $this->setIndividualSenderRequirementsEnabled()
	 *
	 * @param bool|null $individualSenderRequirementsEnabled
	 *
	 * @deprecated - Invalid name of the function
	 */
	public function setIndividualSenderRequiredmentsEnabled($individualSenderRequirementsEnabled) {
		trigger_error(
			'Called deprecated method ' . __METHOD__ . ': Use setIndividualSenderRequirementsEnabled() instead, this method will removed in the future!',
			E_USER_DEPRECATED
		);

		$this->setIndividualSenderRequirementsEnabled($individualSenderRequirementsEnabled);
	}

	/**
	 * Alias for $this->getIndividualSenderRequirementsText()
	 *
	 * @return null|string
	 *
	 * @deprecated - Invalid name of the function
	 */
	public function getIndividualSenderRequiredmentsText() {
		trigger_error(
			'Called deprecated method ' . __METHOD__ . ': Use getIndividualSenderRequirementsText() instead, this method will removed in the future!',
			E_USER_DEPRECATED
		);

		return $this->getIndividualSenderRequirementsText();
	}

	/**
	 * Alias for $this->setIndividualSenderRequirementsText()
	 *
	 * @param null|string $individualSenderRequirementsText
	 *
	 * @deprecated - Invalid name of the function
	 */
	public function setIndividualSenderRequiredmentsText($individualSenderRequirementsText) {
		trigger_error(
			'Called deprecated method ' . __METHOD__ . ': Use setIndividualSenderRequirementsText() instead, this method will removed in the future!',
			E_USER_DEPRECATED
		);

		$this->setIndividualSenderRequirementsText($individualSenderRequirementsText);
	}

	/**
	 * @return bool|null
	 */
	public function getIndividualSenderRequirementsEnabled() {
		return $this->individualSenderRequirementsEnabled;
	}

	/**
	 * @param bool|null $individualSenderRequirementsEnabled
	 */
	public function setIndividualSenderRequirementsEnabled($individualSenderRequirementsEnabled) {
		$this->individualSenderRequirementsEnabled = $individualSenderRequirementsEnabled;
	}

	/**
	 * @return null|string
	 */
	public function getIndividualSenderRequirementsText() {
		return $this->individualSenderRequirementsText;
	}

	/**
	 * @param null|string $individualSenderRequirementsText
	 */
	public function setIndividualSenderRequirementsText($individualSenderRequirementsText) {
		$this->individualSenderRequirementsText = $individualSenderRequirementsText;
	}

	/**
	 * @return bool|null
	 */
	public function getPackagingReturn() {
		return $this->packagingReturn;
	}

	/**
	 * @param bool|null $packagingReturn
	 */
	public function setPackagingReturn($packagingReturn) {
		$this->packagingReturn = $packagingReturn;
	}

	/**
	 * Alias for $this->getReturnImmediatelyIfShipmentFailed()
	 *
	 * @return bool|null - Should Package return immediately when the shipping has failed or null for default
	 * 
	 * @deprecated - Invalid name of the function
	 */
	public function getReturnImmediatlyIfShipmentFailed() {
		trigger_error(
			'Called deprecated method ' . __METHOD__ . ': Use getReturnImmediatelyIfShipmentFailed() instead, this method will removed in the future!',
			E_USER_DEPRECATED
		);
		
		return $this->getReturnImmediatelyIfShipmentFailed();
	}

	/**
	 * Alias for $this->setReturnImmediatelyIfShipmentFailed()
	 *
	 * @param bool|null $returnImmediatelyIfShipmentFailed - Should Package return immediately when the shipping has failed or null for default
	 * 
	 * @deprecated - Invalid name of the function
	 */
	public function setReturnImmediatlyIfShipmentFailed($returnImmediatelyIfShipmentFailed) {
		trigger_error(
			'Called deprecated method ' . __METHOD__ . ': Use setReturnImmediatelyIfShipmentFailed() instead, this method will removed in the future!',
			E_USER_DEPRECATED
		);
		
		$this->setReturnImmediatelyIfShipmentFailed($returnImmediatelyIfShipmentFailed);
	}
	
	/**
	 * Get if the Package should return immediately when the shipping has failed
	 * 
	 * @return bool|null - Should Package return immediately when the shipping has failed or null for default
	 */
	public function getReturnImmediatelyIfShipmentFailed() {
		return $this->returnImmediatelyIfShipmentFailed;
	}

	/**
	 * Set if the Package should return immediately when the shipping has failed
	 * 
	 * @param bool|null $returnImmediatelyIfShipmentFailed - Should Package return immediately when the shipping has failed or null for default
	 */
	public function setReturnImmediatelyIfShipmentFailed($returnImmediatelyIfShipmentFailed) {
		$this->returnImmediatelyIfShipmentFailed = $returnImmediatelyIfShipmentFailed;
	}

	/**
	 * Alias for $this->getNoticeOnNonDeliverable()
	 *
	 * @return bool|null
	 *
	 * @deprecated - Invalid name of the function
	 */
	public function getNoticeNonDeliverability() {
		trigger_error(
			'Called deprecated method ' . __METHOD__ . ': Use getNoticeOnNonDeliverable() instead, this method will removed in the future!',
			E_USER_DEPRECATED
		);

		return $this->getNoticeOnNonDeliverable();
	}

	/**
	 * Alias for $this->setNoticeOnNonDeliverable()
	 *
	 * @param bool|null $noticeOnNonDeliverable
	 *
	 * @deprecated - Invalid name of the function
	 */
	public function setNoticeNonDeliverability($noticeOnNonDeliverable) {
		trigger_error(
			'Called deprecated method ' . __METHOD__ . ': Use setNoticeOnNonDeliverable() instead, this method will removed in the future!',
			E_USER_DEPRECATED
		);

		$this->setNoticeOnNonDeliverable($noticeOnNonDeliverable);
	}

	/**
	 * @return bool|null
	 */
	public function getNoticeOnNonDeliverable() {
		return $this->noticeOnNonDeliverable;
	}

	/**
	 * @param bool|null $noticeOnNonDeliverable
	 */
	public function setNoticeOnNonDeliverable($noticeOnNonDeliverable) {
		$this->noticeOnNonDeliverable = $noticeOnNonDeliverable;
	}

	/**
	 * @return bool|null
	 */
	public function getShipmentHandlingEnabled() {
		return $this->shipmentHandlingEnabled;
	}

	/**
	 * @param bool|null $shipmentHandlingEnabled
	 */
	public function setShipmentHandlingEnabled($shipmentHandlingEnabled) {
		$this->shipmentHandlingEnabled = $shipmentHandlingEnabled;
	}

	/**
	 * @return null|string
	 */
	public function getShipmentHandlingType() {
		return $this->shipmentHandlingType;
	}

	/**
	 * @param null|string $shipmentHandlingType
	 */
	public function setShipmentHandlingType($shipmentHandlingType) {
		$this->shipmentHandlingType = $shipmentHandlingType;
	}

	/**
	 * @return bool|null
	 */
	public function getEndorsementEnabled() {
		return $this->endorsementEnabled;
	}

	/**
	 * @param bool|null $endorsementEnabled
	 */
	public function setEndorsementEnabled($endorsementEnabled) {
		$this->endorsementEnabled = $endorsementEnabled;
	}

	/**
	 * @return null|string
	 */
	public function getEndorsementType() {
		return $this->endorsementType;
	}

	/**
	 * @param null|string $endorsementType
	 */
	public function setEndorsementType($endorsementType) {
		$this->endorsementType = $endorsementType;
	}

	/**
	 * @return bool|null
	 */
	public function getVisualCheckOfAgeEnabled() {
		return $this->visualCheckOfAgeEnabled;
	}

	/**
	 * @param bool|null $visualCheckOfAgeEnabled
	 */
	public function setVisualCheckOfAgeEnabled($visualCheckOfAgeEnabled) {
		$this->visualCheckOfAgeEnabled = $visualCheckOfAgeEnabled;
	}

	/**
	 * @return null|string
	 */
	public function getVisualCheckOfAgeType() {
		return $this->visualCheckOfAgeType;
	}

	/**
	 * @param null|string $visualCheckOfAgeType
	 */
	public function setVisualCheckOfAgeType($visualCheckOfAgeType) {
		$this->visualCheckOfAgeType = $visualCheckOfAgeType;
	}

	/**
	 * @return bool|null
	 */
	public function getPreferredLocationEnabled() {
		return $this->preferredLocationEnabled;
	}

	/**
	 * @param bool|null $preferredLocationEnabled
	 */
	public function setPreferredLocationEnabled($preferredLocationEnabled) {
		$this->preferredLocationEnabled = $preferredLocationEnabled;
	}

	/**
	 * @return null|string
	 */
	public function getPreferredLocationDetails() {
		return $this->preferredLocationDetails;
	}

	/**
	 * @param null|string $preferredLocationDetails
	 */
	public function setPreferredLocationDetails($preferredLocationDetails) {
		$this->preferredLocationDetails = $preferredLocationDetails;
	}

	/**
	 * @return bool|null
	 */
	public function getPreferredNeighbourEnabled() {
		return $this->preferredNeighbourEnabled;
	}

	/**
	 * @param bool|null $preferredNeighbourEnabled
	 */
	public function setPreferredNeighbourEnabled($preferredNeighbourEnabled) {
		$this->preferredNeighbourEnabled = $preferredNeighbourEnabled;
	}

	/**
	 * @return null|string
	 */
	public function getPreferredNeighbourText() {
		return $this->preferredNeighbourText;
	}

	/**
	 * @param null|string $preferredNeighbourText
	 */
	public function setPreferredNeighbourText($preferredNeighbourText) {
		$this->preferredNeighbourText = $preferredNeighbourText;
	}

	/**
	 * @return bool|null
	 */
	public function getPreferredDayEnabled() {
		return $this->preferredDayEnabled;
	}

	/**
	 * @param bool|null $preferredDayEnabled
	 */
	public function setPreferredDayEnabled($preferredDayEnabled) {
		$this->preferredDayEnabled = $preferredDayEnabled;
	}

	/**
	 * @return null|string
	 */
	public function getPreferredDayText() {
		return $this->preferredDayText;
	}

	/**
	 * @param null|string $preferredDayText
	 */
	public function setPreferredDayText($preferredDayText) {
		$this->preferredDayText = $preferredDayText;
	}

	/**
	 * @return bool|null
	 *
	 * @deprecated - DHL-API-Version 1 Method
	 */
	public function getGoGreen() {
		trigger_error('[DHL-PHP-SDK]: Version 1 Methods are deprecated and will removed soon (Called method ' . __METHOD__ . ')!', E_USER_DEPRECATED);

		return $this->goGreen;
	}

	/**
	 * @param bool|null $goGreen
	 *
	 * @deprecated - DHL-API-Version 1 Method
	 */
	public function setGoGreen($goGreen) {
		trigger_error('[DHL-PHP-SDK]: Version 1 Methods are deprecated and will removed soon (Called method ' . __METHOD__ . ')!', E_USER_DEPRECATED);

		$this->goGreen = $goGreen;
	}

	/**
	 * @return bool|null
	 */
	public function getPerishables() {
		return $this->perishables;
	}

	/**
	 * @param bool|null $perishables
	 */
	public function setPerishables($perishables) {
		$this->perishables = $perishables;
	}

	/**
	 * @return bool|null
	 *
	 * @deprecated - DHL-API-Version 1 Method
	 */
	public function getPersonalHandover() {
		trigger_error(
			'[DHL-PHP-SDK]: Version 1 Methods are deprecated and will removed soon ( Called method ' . __METHOD__ .
			' - Version 2 Function: getNamedPersonOnly() )!',
			E_USER_DEPRECATED
		);

		return $this->personalHandover;
	}

	/**
	 * @param bool|null $personalHandover
	 *
	 * @deprecated - DHL-API-Version 1 Method
	 */
	public function setPersonalHandover($personalHandover) {
		trigger_error(
			'[DHL-PHP-SDK]: Version 1 Methods are deprecated and will removed soon ( Called method ' . __METHOD__ .
			' - Version2 Function: setNamedPersonOnly($name) )!',
			E_USER_DEPRECATED
		);

		$this->personalHandover = $personalHandover;
	}

	/**
	 * @return bool|null
	 */
	public function getDisableNeighbourDelivery() {
		return $this->disableNeighbourDelivery;
	}

	/**
	 * @param bool|null $disableNeighbourDelivery
	 */
	public function setDisableNeighbourDelivery($disableNeighbourDelivery) {
		$this->disableNeighbourDelivery = $disableNeighbourDelivery;
	}

	/**
	 * @return bool|null
	 */
	public function getNamedPersonOnly() {
		return $this->namedPersonOnly;
	}

	/**
	 * @param bool|null $namedPersonOnly
	 */
	public function setNamedPersonOnly($namedPersonOnly) {
		$this->namedPersonOnly = $namedPersonOnly;
	}

	/**
	 * @return bool|null
	 */
	public function getReturnReceipt() {
		return $this->returnReceipt;
	}

	/**
	 * @param bool|null $returnReceipt
	 */
	public function setReturnReceipt($returnReceipt) {
		$this->returnReceipt = $returnReceipt;
	}

	/**
	 * @return bool|null
	 */
	public function getPremium() {
		return $this->premium;
	}

	/**
	 * @param bool|null $premium
	 */
	public function setPremium($premium) {
		$this->premium = $premium;
	}

	/**
	 * @return bool|null
	 */
	public function getCashOnDeliveryEnabled() {
		return $this->cashOnDeliveryEnabled;
	}

	/**
	 * @param bool|null $cashOnDeliveryEnabled
	 */
	public function setCashOnDeliveryEnabled($cashOnDeliveryEnabled) {
		$this->cashOnDeliveryEnabled = $cashOnDeliveryEnabled;
	}

	/**
	 * @return bool|null
	 */
	public function getCashOnDeliveryAddFee() {
		return $this->cashOnDeliveryAddFee;
	}

	/**
	 * @param bool|null $cashOnDeliveryAddFee
	 */
	public function setCashOnDeliveryAddFee($cashOnDeliveryAddFee) {
		$this->cashOnDeliveryAddFee = $cashOnDeliveryAddFee;
	}

	/**
	 * @return float|null
	 */
	public function getCashOnDeliveryAmount() {
		return $this->cashOnDeliveryAmount;
	}

	/**
	 * @param float|null $cashOnDeliveryAmount
	 */
	public function setCashOnDeliveryAmount($cashOnDeliveryAmount) {
		$this->cashOnDeliveryAmount = $cashOnDeliveryAmount;
	}

	/**
	 * @return bool|null
	 */
	public function getAdditionalInsuranceEnabled() {
		return $this->additionalInsuranceEnabled;
	}

	/**
	 * @param bool|null $additionalInsuranceEnabled
	 */
	public function setAdditionalInsuranceEnabled($additionalInsuranceEnabled) {
		$this->additionalInsuranceEnabled = $additionalInsuranceEnabled;
	}

	/**
	 * @return float|null
	 */
	public function getAdditionalInsuranceAmount() {
		return $this->additionalInsuranceAmount;
	}

	/**
	 * @param float|null $additionalInsuranceAmount
	 */
	public function setAdditionalInsuranceAmount($additionalInsuranceAmount) {
		$this->additionalInsuranceAmount = $additionalInsuranceAmount;
	}

	/**
	 * @return bool|null
	 */
	public function getBulkyGoods() {
		return $this->bulkyGoods;
	}

	/**
	 * @param bool|null $bulkyGoods
	 */
	public function setBulkyGoods($bulkyGoods) {
		$this->bulkyGoods = $bulkyGoods;
	}

	/**
	 * @return bool|null
	 */
	public function getIdentCheckEnabled() {
		return $this->identCheckEnabled;
	}

	/**
	 * @param bool|null $identCheckEnabled
	 */
	public function setIdentCheckEnabled($identCheckEnabled) {
		$this->identCheckEnabled = $identCheckEnabled;
	}

	/**
	 * @return IdentCheck|null
	 */
	public function getIdentCheckObj() {
		return $this->identCheckObj;
	}

	/**
	 * @param IdentCheck|null $identCheckObj
	 */
	public function setIdentCheckObj($identCheckObj) {
		$this->identCheckObj = $identCheckObj;
	}

	/**
	 * Get the Class of this Service-Object
	 *
	 * @param string $productType - Type of the Product
	 * @return StdClass - Service-DHL-Class
	 *
	 * @deprecated - DHL-API-Version 1 Method
	 */
	public function getServiceClass_v1($productType) {
		trigger_error('[DHL-PHP-SDK]: Version 1 Methods are deprecated and will removed soon (Called method ' . __METHOD__ . ')!', E_USER_DEPRECATED);
		trigger_error('[DHL-PHP-SDK]: Called Version 1 Method: ' . __METHOD__ . ' is incomplete (does nothing)!', E_USER_WARNING);

		return new StdClass;
	}

	/**
	 * Get the Class of this Service-Object
	 *
	 * @param string $productType - Type of the Product
	 * @return StdClass - Service-DHL-Class
	 */
	public function getServiceClass_v2($productType) {
		$class = new StdClass;

		if($this->getDayOfDeliveryEnabled() !== null && in_array(
			$productType,
			array(
				ShipmentDetails::PRODUCT_TYPE_SAME_DAY_MESSENGER,
				ShipmentDetails::PRODUCT_TYPE_WISH_TIME_MESSENGER
			))) {
			$class->DayOfDelivery = new StdClass;
			$class->DayOfDelivery->active = (int) $this->getDayOfDeliveryEnabled();
			$class->DayOfDelivery->details = $this->getDayOfDeliveryDate();
		}
		if($this->getDeliveryTimeframeEnabled() !== null && in_array(
				$productType,
				array(
					ShipmentDetails::PRODUCT_TYPE_SAME_DAY_MESSENGER,
					ShipmentDetails::PRODUCT_TYPE_WISH_TIME_MESSENGER
				))) {
			$class->DeliveryTimeframe = new StdClass;
			$class->DeliveryTimeframe->active = (int) $this->getDeliveryTimeframeEnabled();
			$class->DeliveryTimeframe->type = $this->getDeliveryTimeframe();
		}
		if($this->getPreferredTimeEnabled() !== null && in_array(
				$productType,
				array(
					ShipmentDetails::PRODUCT_TYPE_NATIONAL_PACKAGE,
					ShipmentDetails::PRODUCT_TYPE_SAME_DAY_PACKAGE
				))) {
			$class->PreferredTime = new StdClass;
			$class->PreferredTime->active = (int) $this->getPreferredTimeEnabled();
			$class->PreferredTime->type = $this->getPreferredTime();
		}
		if($this->getIndividualSenderRequirementsEnabled() !== null && in_array(
				$productType,
				array(
					ShipmentDetails::PRODUCT_TYPE_SAME_DAY_MESSENGER,
					ShipmentDetails::PRODUCT_TYPE_WISH_TIME_MESSENGER
				))) {
			$class->IndividualSenderRequirement = new StdClass;
			$class->IndividualSenderRequirement->active = (int) $this->getIndividualSenderRequirementsEnabled();
			$class->IndividualSenderRequirement->details = $this->getIndividualSenderRequirementsText();
		}
		if($this->getPackagingReturn() !== null) {
			$class->PackagingReturn = new StdClass;
			$class->PackagingReturn->active = (int) $this->getPackagingReturn();
		}
		if($this->getReturnImmediatelyIfShipmentFailed() !== null && in_array(
				$productType,
				array(
					ShipmentDetails::PRODUCT_TYPE_SAME_DAY_PACKAGE
				))) {
			$class->ReturnImmediately = new StdClass;
			$class->ReturnImmediately->active = (int) $this->getReturnImmediatelyIfShipmentFailed();
		}
		if($this->getNoticeOnNonDeliverable() !== null) {
			$class->NoticeOfNonDeliverability = new StdClass;
			$class->NoticeOfNonDeliverability->active = (int) $this->getNoticeOnNonDeliverable();
		}
		if($this->getShipmentHandlingEnabled() !== null && in_array(
				$productType,
				array(
					ShipmentDetails::PRODUCT_TYPE_SAME_DAY_MESSENGER,
					ShipmentDetails::PRODUCT_TYPE_WISH_TIME_MESSENGER
				))) {
			$class->ShipmentHandling = new StdClass;
			$class->ShipmentHandling->active = (int) $this->getShipmentHandlingEnabled();
			$class->ShipmentHandling->type = $this->getShipmentHandlingType();
		}
		if($this->getEndorsementEnabled() !== null) {
			$class->Endorsement = new StdClass;
			$class->Endorsement->active = (int) $this->getEndorsementEnabled();
			$class->Endorsement->type = $this->getEndorsementType();
		}
		if($this->getVisualCheckOfAgeEnabled() !== null) {
			$class->VisualCheckOfAge = new StdClass;
			$class->VisualCheckOfAge->active = (int) $this->getVisualCheckOfAgeEnabled();
			$class->VisualCheckOfAge->type = $this->getVisualCheckOfAgeType();
		}
		if($this->getPreferredLocationEnabled() !== null) {
			$class->PreferredLocation = new StdClass;
			$class->PreferredLocation->active = (int) $this->getPreferredLocationEnabled();
			$class->PreferredLocation->details = $this->getPreferredLocationDetails();
		}
		if($this->getPreferredNeighbourEnabled() !== null) {
			$class->PreferredNeighbour = new StdClass;
			$class->PreferredNeighbour->active = (int) $this->getPreferredNeighbourEnabled();
			$class->PreferredNeighbour->details = $this->getPreferredNeighbourText();
		}
		if($this->getPreferredDayEnabled() !== null) {
			$class->PreferredDay = new StdClass;
			$class->PreferredDay->active = (int) $this->getPreferredDayEnabled();
			$class->PreferredDay->details = $this->getPreferredDayText();
		}
		if($this->getPerishables() !== null) {
			$class->Perishables = new StdClass;
			$class->Perishables->active = (int) $this->getPerishables();
		}
		if($this->getDisableNeighbourDelivery() !== null) {
			$class->NoNeighbourDelivery = new StdClass;
			$class->NoNeighbourDelivery->active = (int) $this->getDisableNeighbourDelivery();
		}
		if($this->getNamedPersonOnly() !== null) {
			$class->NamedPersonOnly = new StdClass;
			$class->NamedPersonOnly->active = (int) $this->getNamedPersonOnly();
		}
		if($this->getReturnReceipt() !== null) {
			$class->ReturnReceipt = new StdClass;
			$class->ReturnReceipt->active = (int) $this->getReturnReceipt();
		}
		if($this->getPremium() !== null) {
			$class->Premium = new StdClass;
			$class->Premium->active = (int) $this->getPremium();
		}
		if($this->getCashOnDeliveryEnabled() !== null) {
			$class->CashOnDelivery = new StdClass;
			$class->CashOnDelivery->active = (int) $this->getCashOnDeliveryEnabled();
			if($this->getCashOnDeliveryAddFee() !== null)
				$class->CashOnDelivery->addFee = $this->getCashOnDeliveryAddFee();
			$class->CashOnDelivery->codAmount = $this->getCashOnDeliveryAmount();
		}
		if($this->getAdditionalInsuranceEnabled() !== null) {
			$class->AdditionalInsurance = new StdClass;
			$class->AdditionalInsurance->active = (int) $this->getAdditionalInsuranceEnabled();
			$class->AdditionalInsurance->insuranceAmount = $this->getAdditionalInsuranceAmount();
		}
		if($this->getBulkyGoods() !== null) {
			$class->BulkyGoods = new StdClass;
			$class->BulkyGoods->active = (int) $this->getBulkyGoods();
		}
		if($this->getIdentCheckEnabled() !== null) {
			$class->IdentCheck = new StdClass;
			$class->IdentCheck->active = (int) $this->getIdentCheckEnabled();
			$class->IdentCheck->Ident = $this->getIdentCheckObj()->getIdentClass_v2();
		}

		return $class;
	}
}
