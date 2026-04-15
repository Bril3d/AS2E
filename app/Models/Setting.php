<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function getHomeDefaults($key = null)
    {
        $defaults = [
            'home_hero' => [
                'title' => 'AS2E',
                'subtitle' => 'Automation Systems and Energy Efficiency'
            ],
            'home_carousel' => [],
            'home_features' => [
                'section_title' => 'Advanced Features',
                'section_caption' => 'Driving Efficiency in Automation Systems and Energy Performance',
                'title' => 'Advanced Features',
                'subtitle' => 'Elevating Automation Systems and Energy Performance',
                'description' => 'This could involve implementing sophisticated control systems that optimize energy usage in buildings or industrial processes. The aim is to elevate automation systems beyond basic functionalities, enabling them to dynamically adapt to environmental conditions and user preferences while maximizing energy performance.',
                'image' => 'assets/features.jpg',
                'items' => [
                    'Automated Control Systems',
                    'Energy Management and Monitoring',
                    'Predictive Maintenance with Condition Monitoring'
                ]
            ],
            'home_services' => [
                'section_title' => 'Our Services',
                'section_caption' => 'Empowering Your Operations with Cutting-edge Solutions',
                'main_title' => 'Streamlined Automation for Enhanced Operational Efficiency',
                'description' => 'We specialize in developing and implementing automation solutions that optimize your processes and enhance energy efficiency. Our goal is to bring innovation and efficiency to your operations.',
                'items' => [
                    [
                        'title' => 'Intelligent Process Automation',
                        'description' => 'Our advanced automation tools streamline your processes, improving accuracy and efficiency across various operational tasks.',
                        'icon' => 'Book'
                    ],
                    [
                        'title' => 'Energy Optimization Solutions',
                        'description' => 'We design and implement energy-efficient solutions, leveraging automation to minimize energy consumption and environmental impact.',
                        'icon' => 'Settings'
                    ],
                    [
                        'title' => 'Customized Integration Solutions',
                        'description' => 'Our comprehensive documentation and client libraries simplify the integration process, enabling custom solutions tailored to your unique needs.',
                        'icon' => 'Layers'
                    ]
                ]
            ],
            'home_stats' => [
                'section_title' => 'Project Stats',
                'section_caption' => 'Key metrics for our software development project',
                'items' => [
                    ['title' => 'Accuracy rate', 'value' => '99.95%', 'description' => 'in fulfilling orders'],
                    ['title' => 'Team Members', 'value' => '50+', 'description' => 'dedicated team members'],
                    ['title' => 'Happy customer', 'value' => '85%', 'description' => 'this year alone']
                ]
            ],
            'home_faq' => [
                'section_title' => 'FAQ',
                'section_caption' => 'Frequently Asked Questions',
                'title' => 'Explore Common Queries',
                'description' => 'Find answers to common questions about Automation Systems and Energy Efficiency.',
                'items' => [
                    [
                        'question' => 'How can automation enhance energy efficiency?',
                        'answer' => 'Automation can optimize energy consumption by intelligently controlling systems. For instance, smart lighting and HVAC systems can adjust based on occupancy, leading to significant energy savings.'
                    ],
                    [
                        'question' => 'What role does data analytics play in energy efficiency systems?',
                        'answer' => 'Data analytics enables the identification of energy usage patterns, helping businesses make informed decisions to optimize consumption, reduce waste, and enhance overall energy efficiency.'
                    ],
                    [
                        'question' => 'Are there specific automation solutions for renewable energy systems?',
                        'answer' => 'Yes, there are automation solutions tailored for renewable energy systems. These include smart grids, energy storage management, and real-time monitoring to maximize the utilization of renewable resources.'
                    ]
                ]
            ]
        ];

        if ($key) {
            return $defaults[$key] ?? null;
        }

        return $defaults;
    }
}
