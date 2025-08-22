import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';

interface Metrics {
    totalCompanies: number;
    totalContacts: number;
    totalDeals: number;
    totalLeads: number;
    overdueTasks: number;
    totalRevenue: number;
    pipelineValue: number;
    avgDealValue: number;
}

interface Deal {
    id: number;
    name: string;
    value: number;
    stage: string;
    company?: {
        name: string;
    };
    contact?: {
        first_name: string;
        last_name: string;
    };
    created_at: string;
}

interface Task {
    id: number;
    title: string;
    type: string;
    priority: string;
    due_date: string;
    assigned_user: {
        name: string;
    };
    taskable_type: string;
    taskable?: {
        name?: string;
        first_name?: string;
        last_name?: string;
    };
}

interface DealsByStage {
    stage: string;
    count: number;
    total_value: number;
}

interface LeadsBySource {
    source: string;
    count: number;
}

interface Props {
    metrics: Metrics;
    recentDeals: Deal[];
    upcomingTasks: Task[];
    dealsByStage: DealsByStage[];
    leadsBySource: LeadsBySource[];
    [key: string]: unknown;
}

export default function Dashboard({ 
    metrics, 
    recentDeals, 
    upcomingTasks, 
    dealsByStage, 
    leadsBySource 
}: Props) {
    const formatCurrency = (amount: number) => {
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
            minimumFractionDigits: 0,
        }).format(amount);
    };

    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleDateString();
    };

    const getPriorityColor = (priority: string) => {
        switch (priority) {
            case 'urgent': return 'text-red-600 bg-red-100';
            case 'high': return 'text-orange-600 bg-orange-100';
            case 'medium': return 'text-yellow-600 bg-yellow-100';
            default: return 'text-gray-600 bg-gray-100';
        }
    };

    const getStageColor = (stage: string) => {
        switch (stage) {
            case 'closed_won': return 'text-green-600 bg-green-100';
            case 'closed_lost': return 'text-red-600 bg-red-100';
            case 'negotiation': return 'text-purple-600 bg-purple-100';
            case 'proposal': return 'text-blue-600 bg-blue-100';
            default: return 'text-gray-600 bg-gray-100';
        }
    };

    return (
        <AppShell>
            <Head title="CRM Dashboard" />
            
            <div className="space-y-8">
                {/* Header */}
                <div>
                    <h1 className="text-3xl font-bold text-gray-900">📊 CRM Dashboard</h1>
                    <p className="text-gray-600 mt-2">Welcome back! Here's what's happening with your business.</p>
                </div>

                {/* Key Metrics */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <Link href="/contacts" className="bg-white p-6 rounded-lg shadow hover:shadow-md transition-shadow">
                        <div className="flex items-center">
                            <div className="flex-shrink-0">
                                <div className="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <span className="text-blue-600 font-semibold">👥</span>
                                </div>
                            </div>
                            <div className="ml-4">
                                <p className="text-sm font-medium text-gray-600">Contacts</p>
                                <p className="text-2xl font-semibold text-gray-900">{metrics.totalContacts.toLocaleString()}</p>
                            </div>
                        </div>
                    </Link>

                    <Link href="/companies" className="bg-white p-6 rounded-lg shadow hover:shadow-md transition-shadow">
                        <div className="flex items-center">
                            <div className="flex-shrink-0">
                                <div className="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                    <span className="text-green-600 font-semibold">🏢</span>
                                </div>
                            </div>
                            <div className="ml-4">
                                <p className="text-sm font-medium text-gray-600">Companies</p>
                                <p className="text-2xl font-semibold text-gray-900">{metrics.totalCompanies.toLocaleString()}</p>
                            </div>
                        </div>
                    </Link>

                    <Link href="/deals" className="bg-white p-6 rounded-lg shadow hover:shadow-md transition-shadow">
                        <div className="flex items-center">
                            <div className="flex-shrink-0">
                                <div className="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <span className="text-purple-600 font-semibold">💰</span>
                                </div>
                            </div>
                            <div className="ml-4">
                                <p className="text-sm font-medium text-gray-600">Active Deals</p>
                                <p className="text-2xl font-semibold text-gray-900">{metrics.totalDeals.toLocaleString()}</p>
                            </div>
                        </div>
                    </Link>

                    <Link href="/leads" className="bg-white p-6 rounded-lg shadow hover:shadow-md transition-shadow">
                        <div className="flex items-center">
                            <div className="flex-shrink-0">
                                <div className="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                                    <span className="text-orange-600 font-semibold">🎯</span>
                                </div>
                            </div>
                            <div className="ml-4">
                                <p className="text-sm font-medium text-gray-600">Leads</p>
                                <p className="text-2xl font-semibold text-gray-900">{metrics.totalLeads.toLocaleString()}</p>
                            </div>
                        </div>
                    </Link>
                </div>

                {/* Revenue Metrics */}
                <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div className="bg-white p-6 rounded-lg shadow">
                        <h3 className="text-lg font-semibold text-gray-900 mb-2">💵 Total Revenue</h3>
                        <p className="text-3xl font-bold text-green-600">{formatCurrency(metrics.totalRevenue)}</p>
                        <p className="text-sm text-gray-600 mt-1">Closed won deals</p>
                    </div>

                    <div className="bg-white p-6 rounded-lg shadow">
                        <h3 className="text-lg font-semibold text-gray-900 mb-2">📈 Pipeline Value</h3>
                        <p className="text-3xl font-bold text-blue-600">{formatCurrency(metrics.pipelineValue)}</p>
                        <p className="text-sm text-gray-600 mt-1">Active opportunities</p>
                    </div>

                    <div className="bg-white p-6 rounded-lg shadow">
                        <h3 className="text-lg font-semibold text-gray-900 mb-2">📊 Avg Deal Value</h3>
                        <p className="text-3xl font-bold text-purple-600">{formatCurrency(metrics.avgDealValue)}</p>
                        <p className="text-sm text-gray-600 mt-1">Average deal size</p>
                    </div>
                </div>

                {/* Tasks Alert */}
                {metrics.overdueTasks > 0 && (
                    <div className="bg-red-50 border border-red-200 rounded-lg p-4">
                        <div className="flex">
                            <div className="flex-shrink-0">
                                <span className="text-red-400 text-xl">⚠️</span>
                            </div>
                            <div className="ml-3">
                                <h3 className="text-sm font-medium text-red-800">
                                    You have {metrics.overdueTasks} overdue tasks
                                </h3>
                                <div className="mt-2">
                                    <Link
                                        href="/tasks"
                                        className="text-sm font-medium text-red-800 underline hover:text-red-900"
                                    >
                                        View overdue tasks →
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                )}

                <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    {/* Recent Deals */}
                    <div className="bg-white p-6 rounded-lg shadow">
                        <div className="flex items-center justify-between mb-4">
                            <h3 className="text-lg font-semibold text-gray-900">Recent Deals</h3>
                            <Link href="/deals" className="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                View all →
                            </Link>
                        </div>
                        <div className="space-y-3">
                            {recentDeals.length > 0 ? (
                                recentDeals.map((deal) => (
                                    <div key={deal.id} className="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div>
                                            <Link 
                                                href={`/deals/${deal.id}`}
                                                className="font-medium text-gray-900 hover:text-blue-600"
                                            >
                                                {deal.name}
                                            </Link>
                                            <p className="text-sm text-gray-600">
                                                {deal.company?.name} • {deal.contact?.first_name} {deal.contact?.last_name}
                                            </p>
                                        </div>
                                        <div className="text-right">
                                            <p className="font-semibold text-gray-900">{formatCurrency(deal.value)}</p>
                                            <span className={`inline-block px-2 py-1 text-xs font-medium rounded-full ${getStageColor(deal.stage)}`}>
                                                {deal.stage.replace('_', ' ')}
                                            </span>
                                        </div>
                                    </div>
                                ))
                            ) : (
                                <p className="text-gray-500 text-center py-4">No recent deals</p>
                            )}
                        </div>
                    </div>

                    {/* Upcoming Tasks */}
                    <div className="bg-white p-6 rounded-lg shadow">
                        <div className="flex items-center justify-between mb-4">
                            <h3 className="text-lg font-semibold text-gray-900">Upcoming Tasks</h3>
                            <Link href="/tasks" className="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                View all →
                            </Link>
                        </div>
                        <div className="space-y-3">
                            {upcomingTasks.length > 0 ? (
                                upcomingTasks.map((task) => (
                                    <div key={task.id} className="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                        <div>
                                            <Link 
                                                href={`/tasks/${task.id}`}
                                                className="font-medium text-gray-900 hover:text-blue-600"
                                            >
                                                {task.title}
                                            </Link>
                                            <p className="text-sm text-gray-600">
                                                {task.type} • {task.assigned_user.name}
                                            </p>
                                        </div>
                                        <div className="text-right">
                                            <p className="text-sm text-gray-600">{formatDate(task.due_date)}</p>
                                            <span className={`inline-block px-2 py-1 text-xs font-medium rounded-full ${getPriorityColor(task.priority)}`}>
                                                {task.priority}
                                            </span>
                                        </div>
                                    </div>
                                ))
                            ) : (
                                <p className="text-gray-500 text-center py-4">No upcoming tasks</p>
                            )}
                        </div>
                    </div>

                    {/* Deal Stages */}
                    <div className="bg-white p-6 rounded-lg shadow">
                        <h3 className="text-lg font-semibold text-gray-900 mb-4">Deals by Stage</h3>
                        <div className="space-y-3">
                            {dealsByStage.map((stage) => (
                                <div key={stage.stage} className="flex items-center justify-between">
                                    <div>
                                        <span className="font-medium text-gray-900">
                                            {stage.stage.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase())}
                                        </span>
                                        <span className="text-sm text-gray-600 ml-2">({stage.count} deals)</span>
                                    </div>
                                    <div className="font-semibold text-gray-900">
                                        {formatCurrency(stage.total_value)}
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>

                    {/* Lead Sources */}
                    <div className="bg-white p-6 rounded-lg shadow">
                        <h3 className="text-lg font-semibold text-gray-900 mb-4">Lead Sources</h3>
                        <div className="space-y-3">
                            {leadsBySource.map((source) => (
                                <div key={source.source} className="flex items-center justify-between">
                                    <span className="font-medium text-gray-900">
                                        {source.source.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase())}
                                    </span>
                                    <span className="font-semibold text-gray-900">{source.count}</span>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>

                {/* Quick Actions */}
                <div className="bg-white p-6 rounded-lg shadow">
                    <h3 className="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                    <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <Link
                            href="/contacts/create"
                            className="flex items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-400 hover:bg-blue-50 transition-colors group"
                        >
                            <div className="text-center">
                                <span className="text-2xl mb-2 block group-hover:scale-110 transition-transform">👤</span>
                                <span className="text-sm font-medium text-gray-700 group-hover:text-blue-600">Add Contact</span>
                            </div>
                        </Link>

                        <Link
                            href="/companies/create"
                            className="flex items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-400 hover:bg-blue-50 transition-colors group"
                        >
                            <div className="text-center">
                                <span className="text-2xl mb-2 block group-hover:scale-110 transition-transform">🏢</span>
                                <span className="text-sm font-medium text-gray-700 group-hover:text-blue-600">Add Company</span>
                            </div>
                        </Link>

                        <Link
                            href="/deals/create"
                            className="flex items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-400 hover:bg-blue-50 transition-colors group"
                        >
                            <div className="text-center">
                                <span className="text-2xl mb-2 block group-hover:scale-110 transition-transform">💰</span>
                                <span className="text-sm font-medium text-gray-700 group-hover:text-blue-600">Create Deal</span>
                            </div>
                        </Link>

                        <Link
                            href="/tasks/create"
                            className="flex items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-400 hover:bg-blue-50 transition-colors group"
                        >
                            <div className="text-center">
                                <span className="text-2xl mb-2 block group-hover:scale-110 transition-transform">✅</span>
                                <span className="text-sm font-medium text-gray-700 group-hover:text-blue-600">Add Task</span>
                            </div>
                        </Link>
                    </div>
                </div>
            </div>
        </AppShell>
    );
}