<?php
namespace Commands;
use Symfony\Component\Console as Console;
class ExtractCommand extends Console\Command\Command
{
    public function __construct($name = null)
    {
        parent::__construct($name);
        $this->setDescription('Crawler products');
        $this->setHelp('Do you need any help');
        $this->addArgument('name', Console\Input\InputArgument::OPTIONAL, 'The name to output to the screen', 'World');
        $this->addOption('more', 'm', Console\Input\InputOption::VALUE_NONE, 'Tell me more');
    }
    protected function execute(Console\Input\InputInterface $input, Console\Output\OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $output->writeln(sprintf('Hello %s!', $name));
        if ($input->getOption('more')) {
            $output->writeln('It is really nice to meet you!');
        }
    }
}


//  $n = new Extract('http://www.exhibitorlist.co.uk/top-drawer-home-autumn-2015/exhibitors.php', '.ex-list-item .ex-list-info > a', '.ex-info.social-links');
 
   
