<?php
namespace AppBundle\Command;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateMappingCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('app:mapping:update');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $client = new Client([
            'base_uri' => sprintf(
                '%s:%d',
                $this->getContainer()->getParameter('es_host'),
                $this->getContainer()->getParameter('es_port')
            )
        ]);

        $response = $client->request(
            'PUT',
            '_template/e_sim',
            [
                'json' => $this->getBody()
            ]
        );

        $responseAsJson = $this->getContainer()->get('jms_serializer')->deserialize(
            $response->getBody()->getContents(),
            'array',
            'json'
        );

        if (!empty($responseAsJson['acknowledged']) && $responseAsJson['acknowledged'] === true) {
            $output->writeln('<info>Mapping updated.</info>');
        } else {
            $output->writeln('<error>Error occurred.</error>');
        }
    }

    /**
     * @return string
     */
    private function getBody()
    {
        return [
            'order' => 1,
            'template' => $this->getContainer()->getParameter('es_index') . '_*',
            'mappings' => array_merge(
                $this->getContainer()->get('app.elastic_search.mapping.currency_ratios')->get(),
                $this->getContainer()->get('app.elastic_search.mapping.job_offers')->get(),
                $this->getContainer()->get('app.elastic_search.mapping.product_offers')->get()
            )
        ];
    }
} 