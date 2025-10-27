<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\MeasurementRepository;
use App\Repository\LocationRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class WeatherController extends AbstractController
{
    #[Route('/weather/{city}/{country?}', name: 'app_weather')]
    public function city(
        string $city,
        ?string $country,
        LocationRepository $locationRepository,
        MeasurementRepository $measurementRepository
    ): Response {
        $city = ucfirst(strtolower($city));
        $criteria = ['city' => $city];

        if ($country) {
            $criteria['country'] = strtoupper($country);
        }

        $location = $locationRepository->findOneBy($criteria);

        if (!$location) {
            return new Response("Location not found", 404);
        }

        $measurements = $measurementRepository->findByLocation($location);

        return $this->render('weather/city.html.twig', [
            'location' => $location,
            'measurements' => $measurements,
        ]);
    }
}
