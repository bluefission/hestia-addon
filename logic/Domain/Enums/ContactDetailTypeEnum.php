<?php

namespace AddOns\Hestia\Domain\Enums;

enum ContactDetailTypeEnum: string {
	case PHONE = 'Phone';
	case MOBILE = 'Mobile';
	case EMAIL = 'Email';
	case FAX = 'Fax';
	case WEBSITE = 'Website';
	case META = 'Meta';
	case X = 'X';
	case LINKEDIN = 'LinkedIn';
	case INSTAGRAM = 'Instagram';
	case YOUTUBE = 'YouTube';
	case PINTEREST = 'Pinterest';
	case SNAPCHAT = 'Snapchat';
	case TIKTOK = 'TikTok';
	case WHATSAPP = 'WhatsApp';
	case TELEGRAM = 'Telegram';
	case SIGNAL = 'Signal';
	case SKYPE = 'Skype';
	case DISCORD = 'Discord';
	case SLACK = 'Slack';
	case OTHER = 'Other';
}