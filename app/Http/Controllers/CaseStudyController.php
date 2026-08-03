<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaseStudyController extends Controller
{
    private $caseStudies = [
        [
            "id" => 1,
            "title" => "Social Anxiety Breakthrough",
            "desc" => "Through a personalized approach, this case study explores the journey of overcoming social anxiety.",
            "short_desc" => "Exploring the journey of overcoming social anxiety through CBT and mindfulness.",
            "img" => "asset/case-study/socialAnxietyBreakthrough1.JPG",
            "banner_img" => "asset/homepage/aai1.png",
            "introduction" => "This in-depth case study follows the journey of a client who struggled with severe social anxiety. The client, a university student, felt isolated and unable to participate in class discussions or social events, which was impacting their academic performance and overall well-being.",
            "approach" => "Through a personalized approach, our counselor utilized a combination of Cognitive-Behavioral Therapy (CBT) and Mindfulness-Based Stress Reduction (MBSR). The therapy focused on identifying the client's negative thought patterns and developing practical coping mechanisms.",
            "points" => [
                ["title" => "Cognitive Behavioral Therapy", "desc" => "We challenged irrational fears by examining the evidence and gradually introducing the client to social situations in a controlled manner."],
                ["title" => "Gestalt Therapy", "desc" => "Exercises in mindfulness helped the client stay present and manage the physical symptoms of anxiety, such as a racing heart and shortness of breath."],
                ["title" => "Guided Imagery Therapy", "desc" => "Using guided imagery, the client learned to create a 'safe space' in their mind, which they could access during stressful situations."]
            ],
            "outcome" => "After several months of consistent sessions, the client made significant progress. This case study highlights their journey from avoidance to empowerment.",
            "progress" => [
                "image" => "asset/case-study/banner.png",
                "outcomes" => [
                    "Improved social interactions and reduced anxiety.",
                    "Effective communication and confidence in public speaking.",
                    "Successful management of daily stressors.",
                    "Increased self-esteem and self-worth."
                ]
            ],
            "faqs" => [
                ["q" => "What is mental health, and how can it help me?", "a" => "Mental health is about your emotional, psychological, and social well-being. A therapist can help you develop tools to manage stress, build resilience, and improve your overall quality of life."],
                ["q" => "How long do therapy sessions usually last?", "a" => "Sessions typically last 50 minutes to an hour, but this can vary depending on the type of therapy and your specific needs."]
            ]
        ],

        [
            "id" => 2,
            "title" => "Stronger Relationships",
            "short_desc" => "Building confidence and trust to establish healthier, more meaningful relationships.",
            "img" => "asset/case-study/strongerRelationships2.JPG",
            "banner_img" => "asset/homepage/aai2.png",
            "introduction" => "This case study focuses on a couple facing communication breakdowns and recurring conflicts. Their goal was to rebuild trust and foster a more supportive partnership, moving from a cycle of arguments to one of mutual understanding.",
            "approach" => "The primary therapeutic model used was Emotionally Focused Therapy (EFT), supplemented with communication skill-building exercises. The goal was to help the partners identify negative interaction patterns and express their underlying emotions and needs more effectively.",
            "points" => [
                ["title" => "Identifying Negative Cycles", "desc" => "We mapped out the recurring conflict pattern (e.g., 'pursue-withdraw') that was causing distress in the relationship."],
                ["title" => "Accessing Deeper Emotions", "desc" => "Partners learned to look beyond surface-level anger or frustration to express vulnerable feelings like fear of rejection or loneliness."],
                ["title" => "Creating New Interactions", "desc" => "The couple practiced new ways of communicating that fostered connection and de-escalated conflict, building positive momentum."]
            ],
            "outcome" => "The couple successfully broke their negative cycle and developed a stronger emotional bond. They reported feeling more secure, understood, and optimistic about their future together.",
            "progress" => [
                "image" => "asset/case-study/banner9.jpg",
                "outcomes" => [
                    "Significant reduction in frequency and intensity of arguments.",
                    "Increased emotional intimacy and mutual empathy.",
                    "Development of effective conflict resolution skills.",
                    "Renewed sense of partnership and shared goals."
                ]
            ],
            "faqs" => [
                ["q" => "Can therapy help if only one partner is willing to attend?", "a" => "Yes, individual therapy can still create significant positive change in a relationship. You can learn new ways of communicating and reacting that can shift the dynamic, often encouraging the other partner to join later."],
                ["q" => "Is couples counseling only for people who are married?", "a" => "Not at all. Couples counseling is for any two people in a committed relationship, whether they are dating, engaged, married, or cohabiting."]
            ]
        ],

        [
            "id" => 3,
            "title" => "Stress Management Success",
            "short_desc" => "Helping a client manage academic pressure and anxiety effectively.",
            "img" => "asset/case-study/stressManagementSuccess3.JPG",
            "banner_img" => "asset/homepage/aai3.png",
            "introduction" => "The client, a final-year student, was experiencing overwhelming stress due to academic pressures, leading to burnout, insomnia, and difficulty concentrating. The goal of therapy was to develop a practical toolkit for managing stress and restoring a healthy work-life balance.",
            "approach" => "Our approach was integrative, combining Acceptance and Commitment Therapy (ACT) with practical time management and relaxation techniques. Instead of eliminating stress, we focused on changing the client's relationship with their stressful thoughts and feelings.",
            "points" => [
                ["title" => "Values Clarification", "desc" => "We identified what was truly important to the client beyond grades, helping them reconnect with their personal values."],
                ["title" => "Cognitive Defusion", "desc" => "The client learned techniques to 'unhook' from unhelpful thoughts, observing them without being controlled by them."],
                ["title" => "Mindful Action", "desc" => "We developed a structured, value-driven schedule that included dedicated time for studies, rest, and social activities."]
            ],
            "outcome" => "The client successfully navigated their final semester with significantly reduced anxiety. They learned to work effectively without sacrificing their well-being and developed resilient coping strategies for future challenges.",
            "progress" => [
                "image" => "asset/case-study/banner5.jpg",
                "outcomes" => [
                    "Improved sleep quality and ability to relax.",
                    "Increased focus and academic performance.",
                    "A greater sense of control and less emotional reactivity.",
                    "Established a sustainable routine for work and self-care."
                ]
            ],
            "faqs" => [
                ["q" => "Is stress always a bad thing?", "a" => "Not necessarily. A moderate amount of stress, known as 'eustress,' can be motivating. Therapy helps you manage 'distress,' which is the type of stress that feels overwhelming and negatively impacts your life."],
                ["q" => "What's a simple technique I can use right now?", "a" => "Try 'box breathing': Inhale for 4 seconds, hold for 4 seconds, exhale for 4 seconds, and hold for 4 seconds. Repeat this for a minute to calm your nervous system."]
            ]
        ],

        [
            "id" => 4,
            "title" => "Self-Discovery and Growth",
            "short_desc" => "Empowering an individual through guided self-exploration and finding purpose.",
            "img" => "asset/case-study/selfDiscoveryandGrowth4.JPG",
            "banner_img" => "asset/homepage/aai4.png",
            "introduction" => "This case study features a client who felt 'stuck' and uncertain about their career path and life direction after graduation. They expressed a lack of purpose and low self-esteem. The focus of therapy was on exploration, self-acceptance, and building confidence.",
            "approach" => "We used a Person-Centered and Narrative Therapy approach. The counselor created a non-judgmental space for the client to explore their own story, identify their strengths, and rewrite a future narrative that aligned with their authentic self.",
            "points" => [
                ["title" => "Strength Identification", "desc" => "Through various exercises, we uncovered the client's core strengths and past successes, which had been overlooked."],
                ["title" => "Values Exploration", "desc" => "We worked to clarify the client's personal values, which served as a compass for making meaningful life choices."],
                ["title" => "Goal Setting", "desc" => "The client set small, achievable goals that aligned with their newfound values, building momentum and self-efficacy."]
            ],
            "outcome" => "The client gained a strong sense of self-awareness and direction. They enrolled in a postgraduate course that excited them and reported a significant increase in confidence and optimism.",
            "progress" => [
                "image" => "asset/case-study/banner7.jpg",
                "outcomes" => [
                    "Clearer understanding of personal values and strengths.",
                    "Increased self-esteem and reduced self-criticism.",
                    "Made a confident decision about their career path.",
                    "Developed a proactive and positive outlook on the future."
                ]
            ],
            "faqs" => [
                ["q" => "I feel lost but don't know where to start. Can therapy help?", "a" => "Absolutely. Therapy provides a structured and supportive environment to explore your thoughts and feelings. It's an ideal space for self-discovery when you're feeling uncertain."],
                ["q" => "Is therapy just about talking about my problems?", "a" => "While talking is a key part, it's much more than that. It's a collaborative process of gaining insight, learning new skills, and actively working towards the life you want to live."]
            ]
        ],

        [
            "id" => 5,
            "title" => "From Fear to Freedom",
            "short_desc" => "A journey of healing from a specific phobia and emotional liberation.",
            "img" => "asset/case-study/fromFeartoFreedom5.JPG",
            "banner_img" => "asset/homepage/aai5.png",
            "introduction" => "The client presented with a specific phobia (cynophobia, fear of dogs) that was severely limiting their life. They avoided parks, visiting friends with pets, and experienced intense anxiety when encountering a dog unexpectedly. The goal was to reduce the fear response and regain freedom of movement.",
            "approach" => "The primary treatment was Systematic Desensitization, a form of Exposure Therapy. This involved pairing relaxation techniques with gradually increasing exposure to the feared object, both in imagination and in real life, in a controlled and safe manner.",
            "points" => [
                ["title" => "Relaxation Training", "desc" => "The client first mastered deep breathing and progressive muscle relaxation to have tools to manage anxiety."],
                ["title" => "Creating a Fear Hierarchy", "desc" => "We created a list of scenarios involving dogs, ranked from least scary (looking at a photo) to most scary (petting a calm dog)."],
                ["title" => "Gradual Exposure", "desc" => "Starting with the least scary item, the client was exposed to each step of the hierarchy while using relaxation techniques until the fear subsided."]
            ],
            "outcome" => "The client successfully overcame their phobia. They are now able to walk through parks comfortably and visit friends' homes without debilitating fear, reporting a profound sense of liberation and empowerment.",
            "progress" => [
                "image" => "asset/case-study/banner3.jpg",
                "outcomes" => [
                    "Elimination of the phobic response to dogs.",
                    "Ability to engage in previously avoided social activities.",
                    "A learned framework for confronting other fears.",
                    "Significant decrease in overall daily anxiety."
                ]
            ],
            "faqs" => [
                ["q" => "Is exposure therapy safe?", "a" => "Yes, when conducted by a trained professional, it is a very safe and effective treatment. The process is gradual and always controlled by the client, who is never forced to do anything they are not ready for."],
                ["q" => "How long does it take to overcome a phobia?", "a" => "The duration varies, but specific phobias are often one of the more quickly treatable anxiety disorders, with significant progress often seen in a matter of weeks or a few months."]
            ]
        ],

        [
            "id" => 6,
            "title" => "Navigating Grief",
            "short_desc" => "Supporting a client coping with loss and finding a path forward.",
            "img" => "asset/case-study/navigatingGrief6.JPG",
            "banner_img" => "asset/homepage/aai6.png",
            "introduction" => "This case study details the therapeutic journey of a client experiencing complicated grief after the sudden loss of a close family member. The client felt stuck in their sadness, isolated from others, and struggled to find meaning in their daily life.",
            "approach" => "We employed an Integrative Grief Counseling approach, which provided a safe and empathetic space to process the loss. It incorporated elements of Narrative Therapy to help the client reconstruct their story and find ways to maintain a connection with their loved one while moving forward.",
            "points" => [
                ["title" => "Processing the Pain", "desc" => "The initial focus was on validating the client's pain and allowing them to express their feelings of sadness, anger, and guilt without judgment."],
                ["title" => "Memorializing and Continuing Bonds", "desc" => "We explored healthy ways to remember and honor the deceased, shifting the focus from the pain of the loss to the love of the relationship."],
                ["title" => "Reconstructing a New Reality", "desc" => "The client worked on finding new sources of meaning and purpose, gradually reinvesting their energy into life and relationships."]
            ],
            "outcome" => "The client was able to integrate their grief into their life in a healthy way. While the sadness remained, it no longer dominated their existence, and they were able to re-engage with life with a renewed sense of hope and purpose.",
            "progress" => [
                "image" => "asset/case-study/banner19.jpg",
                "outcomes" => [
                    "Reduced feelings of isolation and depression.",
                    "Developed healthy coping mechanisms for moments of intense grief.",
                    "Ability to recall positive memories without being overwhelmed by pain.",
                    "Re-established social connections and engagement in meaningful activities."
                ]
            ],
            "faqs" => [
                ["q" => "Is there a 'right' way to grieve?", "a" => "No, grief is a highly personal and unique experience. There is no timeline or correct set of emotions. Therapy provides a space to honor your individual grieving process."],
                ["q" => "What if I feel like I'm not making progress?", "a" => "Grief is not a linear process; it often comes in waves. It's normal to have good days and bad days. A therapist can help you navigate this journey and reassure you that what you're experiencing is a valid part of healing."]
            ]
        ],
    ];
    public function index()
    {
        $indexData = array_map(function ($case) {
            return [
                'id' => $case['id'],
                'title' => $case['title'],
                'desc' => $case['short_desc'],
                'img' => $case['img'],
            ];
        }, $this->caseStudies);

        return view('case-studies.index', ['caseStudies' => $indexData]);
    }

    public function show($id)
    {
        $caseStudy = collect($this->caseStudies)->firstWhere('id', $id);
        abort_if(!$caseStudy, 404, 'Case Study not found');

        return view('case-studies.show', [
            'caseStudy' => $caseStudy
        ]);
    }
}
