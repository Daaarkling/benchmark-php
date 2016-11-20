<?php


namespace Benchmark\Converters\ProtobufPhpProtobuf;


use Benchmark\Converters\IDataConverter;
use Nette\Utils\Json;
use Protobuf\WriteContext;

class ProtobufConverter implements IDataConverter
{


	public function convertData($jsonTestData)
	{
		$arrayData = Json::decode($jsonTestData, Json::FORCE_ARRAY);

		$restaurantCollection = new RestaurantCollection();
		$restaurantCollection->setStatus($arrayData['status']);
		$restaurantCollection->setCode($arrayData['code']);
		$restaurantCollection->setTotalNumber($arrayData['totalNumber']);
		$restaurantCollection->setPage($arrayData['page']);
		$restaurantCollection->setPageSize($arrayData['pageSize']);
		$restaurantCollection->setTotalPages($arrayData['totalPages']);

		foreach ($arrayData['restaurants'] as $data) {

			$restaurant = new Restaurant();
			$restaurant->setId($data['id']);
			$restaurant->setName($data['name']);
			$restaurant->setDescription($data['description']);
			$restaurant->setImageLink($data['imageLink']);
			$restaurant->setMenuLink($data['menuLink']);

			$contact = new Contact();
			if (key_exists('contact', $data)) {
				$contact->setId($data['contact']['id']);
				$contact->setEmail($data['contact']['email']);
				$contact->setWeb($data['contact']['web']);
				$contact->setFacebook($data['contact']['facebook']);
				$contact->setTelephone($data['contact']['telephone']);
			}
			$restaurant->setContact($contact);

			$address = new Address();
			if (key_exists('contact', $data)) {
				$address->setId($data['address']['id']);
				$address->setLatitude($data['address']['latitude']);
				$address->setLongitude($data['address']['longitude']);
				$address->setStreet($data['address']['street']);
				$address->setPostalCode($data['address']['postalCode']);
				$address->setCountry($data['address']['country']);
				$address->setLocality($data['address']['locality']);
			}
			$restaurant->setAddress($address);

			if ($data['openingTimes']) {
				foreach ($data['openingTimes'] as $arrayOpeningTime) {
					$openingTime = new OpeningTime();
					$openingTime->setRestaurant($restaurant);
					$openingTime->setId($arrayOpeningTime['id']);
					$openingTime->setDay($arrayOpeningTime['day']);
					$openingTime->setStart($arrayOpeningTime['start']);
					$openingTime->setEnd($arrayOpeningTime['end']);
					$restaurant->addOpeningTime($openingTime);
				}
			}


			$restaurantCollection->addRestaurant($restaurant);
		}


		var_dump($restaurantCollection->toStream());
		exit;

		return $restaurantCollection;
	}


}