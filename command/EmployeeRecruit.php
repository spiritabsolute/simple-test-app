<?php
namespace Command;

use App\Employee\Name;
use App\Employee\Phone;
use App\Employee\PhoneCollection;
use App\Employee\Service\Staff;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

class EmployeeRecruit extends Command
{
	private $container;

	public function __construct(ContainerInterface $container, string $name = null)
	{
		parent::__construct($name);

		$this->container = $container;
	}

	protected function configure()
	{
		parent::configure();

		$this->setName('app:employee-recruit');
		$this->setDescription('Recruit a new employee');

		$this->addArgument('first', InputArgument::OPTIONAL, 'The first name of employee');
		$this->addArgument('last', InputArgument::OPTIONAL, 'The last name of employee');

		$this->addArgument('phone', InputArgument::OPTIONAL, 'The phone of employee');
		$this->addArgument('phoneChoice', InputArgument::OPTIONAL, 'Add a new phone?');
		$this->addArgument('phoneAnother', InputArgument::OPTIONAL, 'Add another phone?');
	}

	public function execute(InputInterface $input, OutputInterface $output)
	{
		$output->writeln('<comment>Creating an employee</comment>');

		$name = $this->getInputName($input, $output);
		$phoneCollection = $this->getInputPhones($input, $output);

		/** @var Staff $staffService */
		$staffService = $this->container->get(Staff::class);
		$employee = $staffService->recruitEmployee($name, $phoneCollection);

		$output->writeln('<info>Done!</info>');

		return 0;
	}

	private function getInputName(InputInterface $input, OutputInterface $output): Name
	{
		$first = $this->getInput($input, $output, 'first', 'Input employee first name: ');
		$last = $this->getInput($input, $output, 'last', 'Input employee last name: ');
		return new Name($first, $last);
	}

	private function getInputPhones(InputInterface $input, OutputInterface $output): PhoneCollection
	{
		$phoneCollection = new PhoneCollection();

		$phoneChoiceOptions = ['yes' => 'Yes', 'no' => 'No'];
		$phoneChoice = $this->getChoiceInput($input, $output, 'phoneChoice', 'Add a new phone?', $phoneChoiceOptions);

		$phones = [];
		if ($phoneChoice == 'yes')
		{
			$phones = $this->getPhoneInput($input, $output);
		}

		foreach ($phones as $phone)
		{
			$phoneCollection->add($phone);
		}

		return $phoneCollection;
	}

	private function getInput(InputInterface $input, OutputInterface $output, $argumentName, $message)
	{
		$argument = $input->getArgument($argumentName);
		if (empty($argument))
		{
			$question = new Question($message);
			/** @var Helper $helper */
			$helper = $this->getHelper('question');
			$argument = $helper->ask($input, $output, $question);
		}
		return $argument;
	}

	private function getChoiceInput(InputInterface $input, OutputInterface $output, $argumentName, $message, $options)
	{
		$argument = $input->getArgument($argumentName);
		if (empty($argument))
		{
			$question = new ChoiceQuestion($message, $options, current($options));
			/** @var Helper $helper */
			$helper = $this->getHelper('question');
			$argument = $helper->ask($input, $output, $question);
		}
		return $argument;
	}

	private function getPhoneInput(InputInterface $input, OutputInterface $output): array
	{
		$phones = [];

		$code = $this->getInput($input, $output, 'phone', 'Input phone code: ');
		$number = $this->getInput($input, $output, 'phone', 'Input phone number: ');
		$phones[] = new Phone($code, $number);

		$options = ['yes' => 'Yes', 'no' => 'No'];
		$choice = $this->getChoiceInput($input, $output, 'phoneAnother', 'Add another phone?', $options);
		if ($choice == 'yes')
		{
			$phones = array_merge($phones, $this->getPhoneInput($input, $output));
		}

		return $phones;
	}
}