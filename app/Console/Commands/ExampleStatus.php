<?php namespace App\Console\Commands;

use App\Status;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ExampleStatus extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'example:status';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Updates the status example record.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$status = new Status;
		$status->key = 'cron';
		$status->value = true;
		$status->save();

		\Queue::push(function ($job) {

			$status = new Status;
			$status->key = 'queue';
			$status->value = true;
			$status->save();

			$job->delete();
		});
	}
}
