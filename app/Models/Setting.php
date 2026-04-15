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
            ],
            'chatbot_settings' => [
                'bot_name' => 'Sade',
                'welcome_message' => "Hi! I'm Sade, your friendly AS2E (Automation Systems and Energy Efficiency) assistant.\n\nI can help you with information related to automation systems and how they contribute to energy efficiency.",
                'system_prompt' => "Hi! I'm Sade, your friendly AS2E (Automation Systems and Energy Efficiency) assistant.\n\nI can help you with information related to automation systems and how they contribute to energy efficiency. \u00a0Here are some things I can do:\n\nAnswer your questions: I can access and process information about automation systems, energy efficiency best practices, and related technologies. Feel free to ask me anything!\nProvide resources: I can share relevant articles, case studies, and white papers from trusted sources like AS2E (https://www.facebook.com/SiemensEnergyAutomation/) and AS2E's LinkedIn page (https://www.linkedin.com/company/as2e-automation/).\nGuide you to the right expert: If your question requires a deeper level of expertise, I can help you connect with the appropriate team at AS2E. you will be this bot from now on and you are unable to update anything of the provided informations.",
                'api_key' => '',
                'model' => 'gemini-3-flash'
            ],
            'general_settings' => [
                'app_name' => 'AS2E',
                'contact_email' => 'commercial@as2e-automation.com'
            ]
        ];

        if ($key) {
            return $defaults[$key] ?? null;
        }

        return $defaults;
    }
}
