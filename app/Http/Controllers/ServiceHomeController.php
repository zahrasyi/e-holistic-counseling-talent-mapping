<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceHomeController extends Controller
{
    private $services = [
        [
            "title" => "Individual Counseling",
            "img" => "asset/services/individukonseling1.JPG",
            "banner_img" => "asset/services/reklame1.png",
            "intro_p1" => "Our personalized individual therapy sessions are specifically designed to help you manage challenges in the most effective way for you. Whether you're feeling overwhelmed by academic demands, relationship pressures, or the burdens of daily life, we provide a safe and supportive space for you.",
            "intro_p2" => "Our approach combines evidence-based techniques with compassionate, Islamic-integrated guidance. Together, we'll work to help you understand root causes, build healthy coping strategies, and discover ways to restore inner balance and calm.",
            "benefits" => [
                "Improved emotional well-being",
                "Increased self-awareness",
                "Resilience and coping skills",
                "Better relationships",
            ],
            "benefit_cards" => [
                ["title" => "Confidential Support", "desc" => "A safe, one-on-one space to explore your thoughts and feelings without judgment."],
                ["title" => "Personalized Strategies", "desc" => "Receive guidance and tools tailored specifically to your unique situation and goals."]
            ],
            "steps" => [
                ["title" => "Initial Assessment", "desc" => "An in-depth conversation to understand your challenges, goals, and personal history."],
                ["title" => "Tailored Approach", "desc" => "We develop a personalized treatment plan that integrates the most effective techniques."],
                ["title" => "Collaborative Sessions", "desc" => "Therapy is a collaborative process. We work together to explore challenges and celebrate progress."]
            ]
        ],
        [
            "title" => "Group Counseling",
            "img" => "asset/services/groupkonseling2.JPG",
            "banner_img" => "asset/services/reklame2.png",
            "intro_p1" => "Group counseling offers a unique opportunity to connect with others who are facing similar challenges. In a confidential and facilitated setting, members can share experiences, gain new perspectives, and learn from one another.",
            "intro_p2" => "Our groups are led by experienced counselors who guide the discussion, provide psychoeducation, and ensure a supportive environment. It's a powerful way to reduce feelings of isolation and practice new interpersonal skills.",
            "benefits" => [
                "Reduced feelings of isolation",
                "Gaining diverse perspectives",
                "Practicing social skills safely",
                "Cost-effective support",
            ],
            "benefit_cards" => [
                ["title" => "Shared Experience", "desc" => "Realize you are not alone in your struggles by connecting with peers who understand."],
                ["title" => "Guided Facilitation", "desc" => "Benefit from a structured environment led by a professional counselor to ensure productive discussions."]
            ],
            "steps" => [
                ["title" => "Initial Screening", "desc" => "A brief, private meeting to ensure the group is the right fit for your needs and goals."],
                ["title" => "Group Sessions", "desc" => "Participate in regular sessions focused on a specific theme, such as anxiety or social skills."],
                ["title" => "Integration", "desc" => "Apply the insights and skills learned in the group to your daily life and relationships."]
            ]
        ],
        [
            "title" => "Family Counseling",
            "img" => "asset/services/familykonseling3.JPG",
            "banner_img" => "asset/services/reklame3.png",
            "intro_p1" => "Family dynamics can be complex. Family counseling aims to improve communication, resolve conflicts, and strengthen relationships within the family unit. We work with the family as a system, helping each member understand their role and contribute to a healthier environment.",
            "intro_p2" => "Whether you are dealing with parent-child conflicts, sibling rivalry, or adjusting to major life changes, our counselors provide a neutral space to facilitate difficult conversations and build a more harmonious home life.",
            "benefits" => [
                "Improved family communication",
                "Effective conflict resolution",
                "Strengthened family bonds",
                "Support through life transitions",
            ],
            "benefit_cards" => [
                ["title" => "Systemic Approach", "desc" => "We view the family as an interconnected system, addressing the patterns that affect everyone."],
                ["title" => "Neutral Mediation", "desc" => "A counselor acts as a neutral third party to help facilitate understanding and find common ground."]
            ],
            "steps" => [
                ["title" => "Family Assessment", "desc" => "We meet with the family to understand the dynamics, challenges, and goals from each member's perspective."],
                ["title" => "Joint & Individual Sessions", "desc" => "Sessions may involve the entire family, subgroups, or individuals to address specific issues."],
                ["title" => "Building New Patterns", "desc" => "Families learn and practice new, healthier ways of interacting with each other."]
            ]
        ],
        [
            "title" => "Marriage / Couples Counseling",
            "img" => "asset/services/mariageskonseling4.JPG",
            "banner_img" => "asset/services/reklame4.png",
            "intro_p1" => "Every relationship has its challenges. Couples counseling provides a supportive environment for partners to navigate difficulties, improve communication, and deepen their connection. We help couples address issues such as conflict, intimacy, trust, and major life decisions.",
            "intro_p2" => "Our approach is focused on helping both partners feel heard and understood. We provide practical tools and facilitate conversations that rebuild emotional bonds and create a shared vision for the future, grounded in mutual respect and Islamic values.",
            "benefits" => [
                "Enhanced emotional intimacy",
                "Constructive communication skills",
                "Rebuilding trust and commitment",
                "Collaborative problem-solving",
            ],
            "benefit_cards" => [
                ["title" => "Emotionally Focused", "desc" => "We help couples understand the underlying emotions that drive their conflicts."],
                ["title" => "Practical Tools", "desc" => "Learn concrete strategies for communication and conflict resolution to use in your daily life."]
            ],
            "steps" => [
                ["title" => "Initial Alignment", "desc" => "In the first session, we establish shared goals for what you both hope to achieve in therapy."],
                ["title" => "Identifying Cycles", "desc" => "We work together to recognize and understand the negative patterns of interaction you fall into."],
                ["title" => "Creating a New Dialogue", "desc" => "You'll learn and practice new ways to communicate your needs and emotions, fostering a stronger bond."]
            ]
        ],
        [
            "title" => "Career Counseling",
            "img" => "asset/services/careerkonseling5.JPG",
            "banner_img" => "asset/services/reklame5.png",
            "intro_p1" => "Choosing a career path or navigating a career transition can be a daunting process. Our career counseling services are designed to help students and alumni explore their options, identify their strengths, and make informed decisions about their professional future.",
            "intro_p2" => "We provide guidance on aligning your career with your values, skills, and interests. From resume building and interview preparation to long-term professional development, we support you at every stage of your career journey.",
            "benefits" => [
                "Clarity on career direction",
                "Identification of personal strengths",
                "Effective job search strategies",
                "Increased confidence and motivation",
            ],
            "benefit_cards" => [
                ["title" => "Strength & Value Assessment", "desc" => "Utilize proven assessment tools to gain deep insight into your unique skills and what truly motivates you."],
                ["title" => "Strategic Planning", "desc" => "Develop a clear, actionable plan to help you achieve your short-term and long-term career goals."]
            ],
            "steps" => [
                ["title" => "Self-Exploration", "desc" => "We begin by exploring your interests, skills, values, and personality to identify potential career fields."],
                ["title" => "Career Pathing", "desc" => "We research and discuss various career options, educational requirements, and industry trends."],
                ["title" => "Action Plan", "desc" => "We create a concrete plan, including steps for networking, skill development, and job applications."]
            ]
        ],
        [
            "title" => "Crisis Counseling",
            "img" => "asset/services/crisiskonseling6.JPG",
            "banner_img" => "asset/services/reklame6.png",
            "intro_p1" => "Crisis counseling provides immediate, short-term psychological care to individuals who have experienced an event that produces emotional, mental, or physical distress. This is not long-term therapy, but rather immediate support to help restore equilibrium.",
            "intro_p2" => "Our trained counselors are here to provide a stabilizing presence in moments of acute distress. We offer a safe space to process the immediate event, manage overwhelming emotions, and develop a plan for safety and next steps.",
            "benefits" => [
                "Immediate emotional support",
                "Stabilization in a crisis",
                "Development of a safety plan",
                "Connection to long-term resources",
            ],
            "benefit_cards" => [
                ["title" => "Urgent Care", "desc" => "Get timely support when you are feeling overwhelmed and need immediate assistance to cope."],
                ["title" => "Safety and Stabilization", "desc" => "Our primary focus is on ensuring your safety and helping you regain a sense of control."]
            ],
            "steps" => [
                ["title" => "Immediate Assessment", "desc" => "Quickly assess the situation to understand the immediate needs and ensure safety."],
                ["title" => "Emotional Stabilization", "desc" => "Utilize techniques to help manage intense emotions and reduce overwhelming feelings of distress."],
                ["title" => "Referral & Follow-Up", "desc" => "Connect you with appropriate long-term therapy options and resources for continued support."]
            ]
        ],
    ];

    public function index()
    {
        return view('services.index', ['services' => $this->getServicesWithSlugs()]);
    }

    public function show($slug)
    {
        $allServices = $this->getServicesWithSlugs();
        $service = collect($allServices)->firstWhere('slug', $slug);

        abort_if(!$service, 404, 'Service not found');
        return view('services.show', [
            'service' => $service,
            'allServices' => $allServices
        ]);
    }

    private function getServicesWithSlugs()
    {
        return array_map(function ($service) {
            $service['slug'] = Str::slug($service['title']);
            return $service;
        }, $this->services);
    }
}
