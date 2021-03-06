<?php

/**
 * Created by PhpStorm.
 * User: Godluck Akyoo
 * Date: 4/6/2016
 * Time: 8:27 AM
 */
class Seeder extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		// can only be called from the command line
		if (!$this->input->is_cli_request()) {
			exit('Direct access is not allowed');
		}

		// can only be run in the development environment
		if (ENVIRONMENT !== 'development') {
			exit('Wowsers! You don\'t want to do that!');
		}

		// initiate faker
		$this->faker = Faker\Factory::create();

		// load any required models
		//$this->load->model('User_model');
		$this->load->model('Xform_model');
	}

	/**
	 * seed local database
	 */
	function seed()
	{
		// purge existing data
		$this->_truncate_db();

		// seed users
		//$this->_seed_users(25);

		// call dalili za mifugo
		$this->_seed_dalili_za_mifugo_forms(1248);
		$this->_seed_dalili_za_binadamu_forms(1000);
	}

	private function _truncate_db()
	{
		//$this->User_model->truncate();
	}

	function _seed_dalili_za_binadamu_forms($limit)
	{
		echo "seeding $limit dalili za binadamu\n";

		$table_name = "build_dalili_za_binadamu_1418894655";

		for ($i = 0; $i < $limit; $i++) {
			$lat = $this->faker->latitude;
			$lon = $this->faker->longitude;
			$accuracy = $this->faker->randomFloat(10, 0, 50);
			$altitude = $this->faker->randomFloat(10, 0, 4000);

			$dalili_za_binadamu_data = array(
				'meta_instanceID' => 'uuid:' . $this->faker->unique()->uuid,
				'meta_deviceID' => str_replace("-", "", $this->faker->unique()->uuid),
				'taarifa_za_awali_jina_la_mkusanyaji_taarifa' => $this->faker->firstName . " " . $this->faker->lastName,
				'taarifa_za_awali_wilaya' => $this->_get_random_value_from_array(array("Ngorongoro", "Kibaha", "Bagamoyo")),
				'taarifa_za_awali_kijiji' => $this->faker->streetName,
				'taarifa_za_awali_kitongoji' => $this->faker->word,
				'taarifa_za_awali_tarehe_ya_ukusanyaji_taarifa' => $this->faker->date("Y-m-d", "now"),
				'dalili_jinsia' => $this->_get_random_value_from_array(array("Mme", "Mke")),
				'dalili_zinazoonesha' => "",
				'dalili_zingine' => "",
				'Umri_idadi_vifo_umri' => $this->_get_random_value_from_array(array('Chini ya miaka 5', '6 - 18', '19 - 25', '26 - 35', '36 - 45', '56 - 65', 'Zaidi ya 65')), //$this->faker->numberBetween(0,100),
				'Umri_idadi_vifo_Idadi_dalili_chini_miaka_5' => $this->faker->randomDigit,
				'Umri_idadi_vifo_idadi_dalili_watoto' => $this->faker->randomDigit,
				'Umri_idadi_vifo_Idadi_dalili_vijana' => $this->faker->randomDigit,
				'Umri_idadi_vifo_Idadi_dalili_wazee' => $this->faker->randomDigit,
				'Umri_idadi_vifo_idadi_vifo_chini_5' => $this->faker->randomDigit,
				'Umri_idadi_vifo_idadi_vifo_watoto' => $this->faker->randomDigit,
				'Umri_idadi_vifo_idadi_vifo_vijana' => $this->faker->randomDigit,
				'Umri_idadi_vifo_Idadi_vifo_wazee' => $this->faker->randomDigit,
				'GPS_picha_ugonjwa_ugonjwa_unaodhaniwa' => $this->_get_random_value_from_array(array('Malaria', 'Cholera', 'Flue', 'ZIKA', 'Bird Flu')),
				'GPS_picha_ugonjwa_picture' => "", //todo find a way to add random images
				'GPS_picha_ugonjwa_GPS' => $lat . " " . $lon . " " . $accuracy . " " . $altitude,
				'GPS_picha_ugonjwa_GPS_lat' => $lat,
				'GPS_picha_ugonjwa_GPS_lng' => $lon,
				'GPS_picha_ugonjwa_GPS_acc' => $accuracy,
				'GPS_picha_ugonjwa_GPS_alt ' => $altitude
			);

			$this->db->set('`GPS_picha_ugonjwa_GPS_point`', "GeomFromText('POINT(" . $lat . " " . $lon . ")')", FALSE);
			$this->Xform_model->insert_xform_data($table_name, $dalili_za_binadamu_data);
		}

	}

	function _get_random_value_from_array($array = array())
	{
		$rand_key = array_rand($array, 1);
		return $array[$rand_key];
	}

	function _seed_dalili_za_mifugo_forms($limit)
	{
		// 'sacids'.'
		$table_name = "build_dalili_za_mifugo_1418895355";

		echo "seeding $limit dalili za mifugo\n";

		// create a bunch of base symptoms data
		for ($i = 0; $i < $limit; $i++) {
			$lat = $this->faker->latitude;
			$lon = $this->faker->longitude;
			$accuracy = $this->faker->randomFloat(10, 0, 50);
			$altitude = $this->faker->randomFloat(10, 0, 4000);

			$build_dalili_za_mifugo_data = array(
				'meta_instanceID' => 'uuid:' . $this->faker->unique()->uuid,
				'meta_deviceID' => str_replace("-", "", $this->faker->unique()->uuid),
				'taarifa_za_awali_jina_la_mkusanyaji_taarifa' => $this->faker->firstName . " " . $this->faker->lastName,
				'taarifa_za_awali_Wilaya' => $this->_get_random_value_from_array(array('Ngorongoro', 'Kibaha', 'Bagamoyo')),
				'taarifa_za_awali_Kijiji' => $this->faker->streetName,
				'taarifa_za_awali_kitongoji' => $this->faker->word,
				'taarifa_za_awali_tarehe_kukusanya_taarifa' => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
				'dalili_jina_boma' => $this->faker->word,
				'dalili_aina_mifugo_dalili' => $this->_get_random_value_from_array(array('Ng\'ombe', 'Mbuzi', 'Kondoo', 'Punda', 'Mbwa', 'Kuku')),
				'dalili_aina_nyingine_mfugo' => '',
				'dalili_zilizoonekana' => $this->faker->sentence(mt_rand(3, 20)),
				'dalili_zingine' => $this->faker->randomDigit,
				'umri_idadi_Idadi_dalili_wadogo' => $this->faker->randomDigit,
				'umri_idadi_Idadi_dalili_wakubwa' => $this->faker->randomDigit,
				'umri_idadi_idadi_vifo_wadogo' => $this->faker->randomDigit,
				'umri_idadi_Idadi_vifo_wakubwa' => $this->faker->randomDigit,
				'GPS_picha_ugonjwa_ugonjwa_unaodhaniwa' => $this->_get_random_value_from_array(array('RFV', 'FMD', 'ECF', 'PPR', 'CPDP')),
				'GPS_picha_ugonjwa_picture' => '', //$this->faker->image(),
				'GPS_picha_ugonjwa_GPS' => $lat . " " . $lon . " " . $accuracy . " " . $altitude,
				'GPS_picha_ugonjwa_GPS_lat' => $lat,
				'GPS_picha_ugonjwa_GPS_lng' => $lon,
				'GPS_picha_ugonjwa_GPS_acc' => $accuracy,
				'GPS_picha_ugonjwa_GPS_alt' => $altitude
			);
			$this->db->set('`GPS_picha_ugonjwa_GPS_point`', "GeomFromText('POINT(" . $lat . " " . $lon . ")')", FALSE);
			$this->Xform_model->insert_xform_data($table_name, $build_dalili_za_mifugo_data);
		}
	}

	/**
	 * seed users
	 *
	 * @param int $limit
	 */
	function _seed_users($limit)
	{
		echo "seeding $limit users";

		// create a bunch of base buyer accounts
		for ($i = 0; $i < $limit; $i++) {
			echo ".";

			$data = array(
				'username' => $this->faker->unique()->userName, // get a unique nickname
				'password' => 'awesomepassword', // run this via your password hashing function
				'firstname' => $this->faker->firstName,
				'surname' => $this->faker->lastName,
				'address' => $this->faker->streetAddress,
				'city' => $this->faker->city,
				'state' => $this->faker->state,
				'country' => $this->faker->country,
				'postcode' => $this->faker->postcode,
				'email' => $this->faker->email,
				'email_verified' => mt_rand(0, 1) ? '0' : '1',
				'phone' => $this->faker->phoneNumber,
				'birthdate' => $this->faker->dateTimeThisCentury->format('Y-m-d H:i:s'),
				'registration_date' => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
				'ip_address' => mt_rand(0, 1) ? $this->faker->ipv4 : $this->faker->ipv6,
			);

			//$this->User_model->create($data);
		}

		echo PHP_EOL;
	}

}