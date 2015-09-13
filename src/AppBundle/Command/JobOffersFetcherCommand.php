<?php
namespace AppBundle\Command;

use AppBundle\Entity\Country;
use AppBundle\Creator\JobOfferCreator;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class JobOffersFetcherCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('app:job-offers:fetch');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();

        $fetcher = $container->get('app.fetcher.job_offers');
        $populate = $container->get('app.service.collection_populate.job_offers');

        $jobOfferCreator = function (Country $country) use ($container) {
            $jobOfferCreator = $container->get('app.creator.job_offer');
            $jobOfferCreator->getJobOffer()->setCountry($country);

            return $jobOfferCreator;
        };
        $skill = 10;

        foreach ($container->get('app.fetcher.countries')->get() as $country) {
            $pages = 1;
            for ($page = 0; $page < $pages; ++$page) {
                $output->writeln(
                    sprintf(
                        '<comment>[page %d]</comment> Fetch for %s.',
                        $page + 1,
                        $country->getName()
                    )
                );

                $crawler = $fetcher->getCrawler($skill, $country, $page + 1);
                if ($fetcher->isEmptyResult($crawler)) {
                    $output->writeln('<error>Not found offers.</error>');

                    continue;
                }

                if ($page === 0) {
                    $pages = $fetcher->getAmountOfPages($crawler);
                }

                $fetcher->getRows($crawler)->each(
                    function (Crawler $row) use ($country, $crawler, $fetcher, $jobOfferCreator, $populate) {
                        if ($fetcher->isHeaderRow($row)) {
                            return;
                        }

                        /**
                         * @var JobOfferCreator $creator
                         */
                        $creator = $jobOfferCreator($country)
                            ->setRow($row)
                            ->recognizeAndAssignEmployer()
                            ->assignCompany()
                            ->assignSkill()
                            ->assignSalary();

                        $populate->collect($creator->getJobOffer());
                    }
                );
            }

            $output->writeln(
                sprintf('<info>Fetched %d job offers for %s.</info>', $populate->getSize(), $country->getName())
            );

            $populate->populate();
        }
    }
} 