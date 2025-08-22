import React from 'react';
import { Link } from '@inertiajs/react';
import { Head } from '@inertiajs/react';

interface Props {
    canLogin?: boolean;
    canRegister?: boolean;
    [key: string]: unknown;
}

export default function Welcome({ canLogin = false, canRegister = false }: Props) {
    return (
        <>
            <Head title="CRM Dashboard - Manage Your Business Relationships" />
            <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
                {/* Navigation */}
                <nav className="flex items-center justify-between p-6">
                    <div className="flex items-center space-x-2">
                        <div className="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                            <span className="text-white font-bold">📊</span>
                        </div>
                        <span className="text-xl font-bold text-gray-800">PowerCRM</span>
                    </div>
                    
                    {canLogin && (
                        <div className="space-x-4">
                            <Link
                                href="/login"
                                className="text-gray-600 hover:text-gray-800 font-medium transition-colors"
                            >
                                Login
                            </Link>
                            {canRegister && (
                                <Link
                                    href="/register"
                                    className="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700 transition-colors shadow-lg"
                                >
                                    Get Started Free
                                </Link>
                            )}
                        </div>
                    )}
                </nav>

                {/* Hero Section */}
                <div className="max-w-7xl mx-auto px-6 py-16">
                    <div className="text-center mb-16">
                        <h1 className="text-5xl font-bold text-gray-800 mb-6">
                            🤝 Powerful CRM for Growing Teams
                        </h1>
                        <p className="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
                            Manage contacts, track deals, nurture leads, and close more business 
                            with our comprehensive customer relationship management platform.
                        </p>
                        {canLogin && (
                            <div className="space-x-4">
                                <Link
                                    href="/register"
                                    className="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors shadow-lg text-lg"
                                >
                                    Start Your Free Trial
                                </Link>
                                <Link
                                    href="/login"
                                    className="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-50 transition-colors border-2 border-blue-600 text-lg"
                                >
                                    Sign In
                                </Link>
                            </div>
                        )}
                    </div>

                    {/* Features Grid */}
                    <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                        {/* Contacts Management */}
                        <div className="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                            <div className="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                                <span className="text-2xl">👥</span>
                            </div>
                            <h3 className="text-xl font-semibold text-gray-800 mb-3">Contact Management</h3>
                            <p className="text-gray-600 mb-4">
                                Store and organize all your contacts in one place. Track interactions, 
                                add notes, and never miss important details about your relationships.
                            </p>
                            <div className="text-sm text-blue-600 font-medium">
                                ✓ Unlimited contacts  ✓ Company associations  ✓ Custom fields
                            </div>
                        </div>

                        {/* Deal Tracking */}
                        <div className="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                            <div className="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                                <span className="text-2xl">💰</span>
                            </div>
                            <h3 className="text-xl font-semibold text-gray-800 mb-3">Deal Pipeline</h3>
                            <p className="text-gray-600 mb-4">
                                Track deals through your sales pipeline from prospect to close. 
                                Monitor probability, value, and expected close dates.
                            </p>
                            <div className="text-sm text-blue-600 font-medium">
                                ✓ Visual pipeline  ✓ Revenue forecasting  ✓ Stage automation
                            </div>
                        </div>

                        {/* Lead Generation */}
                        <div className="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                            <div className="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-4">
                                <span className="text-2xl">🎯</span>
                            </div>
                            <h3 className="text-xl font-semibold text-gray-800 mb-3">Lead Management</h3>
                            <p className="text-gray-600 mb-4">
                                Capture leads from multiple sources and nurture them through 
                                qualification. Convert qualified leads into customers seamlessly.
                            </p>
                            <div className="text-sm text-blue-600 font-medium">
                                ✓ Multi-source capture  ✓ Lead scoring  ✓ Auto-assignment
                            </div>
                        </div>

                        {/* Task Management */}
                        <div className="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                            <div className="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                                <span className="text-2xl">📋</span>
                            </div>
                            <h3 className="text-xl font-semibold text-gray-800 mb-3">Task & Activity</h3>
                            <p className="text-gray-600 mb-4">
                                Never miss a follow-up with smart task management. Set reminders, 
                                track activities, and stay on top of your sales process.
                            </p>
                            <div className="text-sm text-blue-600 font-medium">
                                ✓ Smart reminders  ✓ Activity timeline  ✓ Team collaboration
                            </div>
                        </div>

                        {/* Company Profiles */}
                        <div className="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                            <div className="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                                <span className="text-2xl">🏢</span>
                            </div>
                            <h3 className="text-xl font-semibold text-gray-800 mb-3">Company Insights</h3>
                            <p className="text-gray-600 mb-4">
                                Get complete company profiles with contact hierarchy, deal history, 
                                and relationship mapping for strategic account management.
                            </p>
                            <div className="text-sm text-blue-600 font-medium">
                                ✓ Company hierarchy  ✓ Revenue tracking  ✓ Industry insights
                            </div>
                        </div>

                        {/* Analytics */}
                        <div className="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                            <div className="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mb-4">
                                <span className="text-2xl">📈</span>
                            </div>
                            <h3 className="text-xl font-semibold text-gray-800 mb-3">Analytics & Reports</h3>
                            <p className="text-gray-600 mb-4">
                                Make data-driven decisions with comprehensive reports on sales 
                                performance, pipeline health, and team productivity.
                            </p>
                            <div className="text-sm text-blue-600 font-medium">
                                ✓ Real-time dashboard  ✓ Custom reports  ✓ Performance metrics
                            </div>
                        </div>
                    </div>

                    {/* Dashboard Preview */}
                    <div className="text-center mb-16">
                        <h2 className="text-3xl font-bold text-gray-800 mb-6">
                            Everything You Need in One Dashboard
                        </h2>
                        <div className="bg-white rounded-2xl shadow-2xl p-8 max-w-4xl mx-auto">
                            <div className="bg-gray-100 rounded-lg p-6">
                                <div className="flex items-center justify-between mb-4">
                                    <h3 className="text-lg font-semibold">📊 CRM Dashboard</h3>
                                    <div className="flex space-x-2">
                                        <div className="w-3 h-3 bg-red-400 rounded-full"></div>
                                        <div className="w-3 h-3 bg-yellow-400 rounded-full"></div>
                                        <div className="w-3 h-3 bg-green-400 rounded-full"></div>
                                    </div>
                                </div>
                                <div className="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                                    <div className="bg-white p-4 rounded-lg">
                                        <div className="text-2xl font-bold text-blue-600">247</div>
                                        <div className="text-sm text-gray-600">Contacts</div>
                                    </div>
                                    <div className="bg-white p-4 rounded-lg">
                                        <div className="text-2xl font-bold text-green-600">42</div>
                                        <div className="text-sm text-gray-600">Active Deals</div>
                                    </div>
                                    <div className="bg-white p-4 rounded-lg">
                                        <div className="text-2xl font-bold text-purple-600">$127K</div>
                                        <div className="text-sm text-gray-600">Pipeline Value</div>
                                    </div>
                                    <div className="bg-white p-4 rounded-lg">
                                        <div className="text-2xl font-bold text-orange-600">18</div>
                                        <div className="text-sm text-gray-600">Tasks Due</div>
                                    </div>
                                </div>
                                <div className="text-sm text-gray-500 text-center">
                                    Real-time insights • Team collaboration • Mobile ready
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* CTA Section */}
                    {canLogin && (
                        <div className="text-center bg-white rounded-2xl p-12 shadow-lg">
                            <h2 className="text-3xl font-bold text-gray-800 mb-4">
                                Ready to Transform Your Sales Process?
                            </h2>
                            <p className="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                                Join thousands of sales teams who have increased their revenue by 40% 
                                with our powerful CRM platform. Start your free trial today!
                            </p>
                            <div className="space-x-4">
                                <Link
                                    href="/register"
                                    className="bg-blue-600 text-white px-8 py-4 rounded-lg font-semibold hover:bg-blue-700 transition-colors shadow-lg text-lg"
                                >
                                    🚀 Get Started - It's Free!
                                </Link>
                                <Link
                                    href="/login"
                                    className="text-blue-600 hover:text-blue-800 font-semibold text-lg underline"
                                >
                                    Already have an account? Sign in →
                                </Link>
                            </div>
                        </div>
                    )}
                </div>

                {/* Footer */}
                <footer className="bg-gray-800 text-white py-12">
                    <div className="max-w-7xl mx-auto px-6 text-center">
                        <div className="flex items-center justify-center space-x-2 mb-4">
                            <div className="w-6 h-6 bg-blue-600 rounded-lg flex items-center justify-center">
                                <span className="text-white text-sm">📊</span>
                            </div>
                            <span className="font-semibold">PowerCRM</span>
                        </div>
                        <p className="text-gray-400">
                            Built with Laravel, React, and TypeScript for modern sales teams.
                        </p>
                    </div>
                </footer>
            </div>
        </>
    );
}