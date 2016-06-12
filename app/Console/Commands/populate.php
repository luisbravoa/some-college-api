<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;
use App\Course;
use App\Period;

class populate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:populate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    public function handle()
    {

        // create user
        $user = new User([
            'name' => 'Luis bravo',
            'email' => 'info@luisbravoa.com',
            'password' => '12345678'
        ]);

        $user->api_token = str_random(60);

        $user->save();

        $courses = [
            [
                'name' => 'Operating Systems Architecture',
                'description' => 'Implementation and design techniques for operating systems. Core material includes advanced kernel-level and device driver programming techniques, how operating systems principles are realised in practice, principles and practice of operating system support for distributed and real-time computing, case studies and different approaches to operating system design and implementation, including different models of software ownership.',
                'periods' => [
                    ['day' => 1, 'start' => 9, 'end' => 11],
                    ['day' => 3, 'start' => 9, 'end' => 11]
                ]
            ],

            [
                'name' => 'Algorithms & Data Structures',
                'description' => 'Data structures & types, mapping of abstract information structures into representations on primary & secondary storage. Analysis of time & space complexity of algorithms. Sequences. Lists. Stacks. Queues. Sets, multisets, tables. Trees. Sorting. Hash tables. Priority queues. Graphs. String algorithms.',
                'periods' => [
                    ['day' => 2, 'start' => 9, 'end' => 11],
                    ['day' => 4, 'start' => 9, 'end' => 11]
                ]
            ],
            [
                'name' => 'Algorithms & Data Structures II',
                'description' => 'Data structures & types, mapping of abstract information structures into representations on primary & secondary storage. Analysis of time & space complexity of algorithms. Sequences. Lists. Stacks. Queues. Sets, multisets, tables. Trees. Sorting. Hash tables. Priority queues. Graphs. String algorithms.',
                'periods' => [
                    ['day' => 2, 'start' => 9, 'end' => 11],
                    ['day' => 4, 'start' => 9, 'end' => 11]
                ]
            ],

            [
                'name' => 'Artificial Intelligence',
                'description' => 'Methods & techniques within the field of artificial intelligence, including problem solving and optimisation by search, representing and reasoning with uncertain knowledge and machine learning. Specific emphasis on the practical utility of algorithms and their implementation in software.',
                'periods' => [
                    ['day' => 2, 'start' => 13, 'end' => 15],
                    ['day' => 4, 'start' => 13, 'end' => 15]
                ]
            ],

            [
                'name' => 'Information Security',
                'description' => 'Access control, Authentication, Security Models, Secret-key and Public-key Cryptography, Network Security and Application-layer Security.',
                'periods' => [
                    ['day' => 3, 'start' => 13, 'end' => 15]
                ]
            ],
            [
                'name' => 'Computer Networks I',
                'description' => 'OSI & Internet reference models. Communication protocols for Local, Metropolitan & Wide Area Networks. BISDN networks.The Internet protocol suite. Mobile Networks. Network security. Trends in communication networks. Quality of service in communication protocols.',
                'periods' => [
                    ['day' => 3, 'start' => 13, 'end' => 14],
                    ['day' => 5, 'start' => 13, 'end' => 16]
                ]
            ],
            [
                'name' => 'The Software Process',
                'description' => 'Software lifecycle as an industrial process, definable, manageable & repeatable. Requirements engineering, object-oriented analysis. Software requirements specification, prototyping, verification & validation, configuration management, maintenance. Software quality, process standards, process improvement. Software engineering tools.',
                'periods' => [
                    ['day' => 4, 'start' => 16, 'end' => 18]
                ]
            ],
            [
                'name' => 'Embedded Systems Design & Interfacing',
                'description' => 'Microcontroller system hardware and software. C programming for embedded microcontroller and peripheral devices. Principles and practice of using Embedded RTOS (Real Time Operating System) and peripheral devices such as sensors and actuators to build a small embedded system. Peripheral interfacing methods and standards. Analog-digital conversion methods and interfacing. Basics of digital communication signals, modulation schemes and error correction methods. Data compression, formats for audio, image and video coding.',
                'periods' => [
                    ['day' => 5, 'start' => 9, 'end' => 11]
                ]
            ],
            [
                'name' => 'Electrical Energy Conversion & Utilisation',
                'description' => 'Generation of electricity. Three phase balanced circuits; magnetic circuits. Transformers. Harmonics. Steady state analysis of dc. Synchronous & induction machines. Special motors. Modern motor control systems. Demand side management. Renewable energy sources. Distributed generation & uninterruptible power supplies.',
                'periods' => [
                    ['day' => 1, 'start' => 9, 'end' => 10]
                ]
            ],
            [
                'name' => '',
                'description' => '',
                'periods' => [
                    ['day' => 1, 'start' => 16, 'end' => 18],
                    ['day' => 3, 'start' => 13, 'end' => 16]
                ]
            ],
            [
                'name' => 'Signals, Systems & Control',
                'description' => 'Discrete-time signals & systems, system properties (linearity, time-invariance, memory, causality, stability), sampling & reconstruction, A/D and D/A converters, DFT/FFT, z transform, stochastic processes, frequency-selective filters, effect of feedback, introduction to control.',
                'periods' => [
                    ['day' => 3, 'start' => 13, 'end' => 16]
                ]
            ],
            [
                'name' => 'Electronic Circuits',
                'description' => 'Detailed examination of electrical & electronic circuit analysis & synthesis tools & techniques such as the Laplace transform, nodal analysis & two port network theory. Examples of use in analysis & design of amplifiers, filters, oscillators, & other circuits.',
                'periods' => [
                    ['day' => 5, 'start' => 13, 'end' => 15]
                ]
            ],
            [
                'name' => 'Web Information Systems',
                'description' => 'Concepts & fundamentals of web-based Information Systems (WIS): HTML, XHTML, CSS, JavaScript, JavaServlet, Java Server Page, client-server database applications on the internet, and XML. Latest and advanced technologies for developing WIS: AJAX, Web Security, Web Search, Web Service and current trends in WIS.',
                'periods' => [
                    ['day' => 2, 'start' => 15, 'end' => 17]
                ]
            ],

        ];

        foreach ($courses as $courseOptions){
            $periods = $courseOptions['periods'];
            $courseModel = new Course($courseOptions);
            $courseModel->save();

            foreach ($periods as $periodOptions){
                $periodModel = new Period($periodOptions);
                $courseModel->periods()->save($periodModel);
            }
        }



        $user->courses()->attach(1);
        $user->courses()->attach(2);

    }
}
